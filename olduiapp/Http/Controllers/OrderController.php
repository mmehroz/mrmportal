<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Order;
use App\User;
use App\OrderLineItem;
use App\OrderLineItemOption;
use App\Product;
use App\Service;
use Carbon\Carbon;
use Config;
use PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Gate;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notifications\newNotification;



class OrderController extends Controller
{
	private $model, $section, $components;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = new \stdClass();
        $this->section->title = 'Invoices';
        $this->section->heading = 'Invoices';
        $this->section->slug = 'order';
        $this->section->folder = 'orders';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
        checkPermission('read-order');
        $section = $this->section;
        $section->heading = 'Invoices';
        $section->title = 'Invoices';
        $section->route = [$section->slug.'.index'];
        $orderDate = Carbon::today()->format('Y-m-d');
        if($request->order_date){
        $orderDate = $request->order_date;
            if (auth()->user()->user_type == 2) {
                 $orders = Order::orderBy('id', "DESC")
                ->with(['orderLineItem'])
                ->where('customer_email', auth()->user()->email)
                ->whereDate('created_at', $orderDate)
                ->get()
                ->toArray();
                 return view($section->folder.'.index', compact('orders', 'section', 'orderDate'));
            }
             $orders = Order::orderBy('id', "DESC")
                ->with(['orderLineItem'])
                ->whereDate('created_at', $orderDate)
                ->get()
                ->toArray();
                 return view($section->folder.'.index', compact('orders', 'section', 'orderDate'));
        }

        // Order::where('id', '>', 0)->update(['flag' => 1]);

		$orders = Order::orderBy('id', "DESC")
        ->with(['orderLineItem'])
        ->whereDate('created_at', $orderDate)
        ->get()
        ->toArray();
		return view($section->folder.'.index', compact('orders', 'section', 'orderDate'));
	}

	public function show(Order $order)
    {
        checkPermission('read-order');
        $section = $this->section;
        $section->heading = 'Invoice';
        $section->title = 'View Invoice';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $order];
        $invoice_logo = file_get_contents(public_path($order->brand->picture));
        $invoice_logo = base64_encode($invoice_logo);
        $today_date = Carbon::now()->format('M d, Y');
        $str = $order->brand->name;
        $invoice_code = null;
        for ($i=0; $i <  strlen($str) ; $i++) {
          if (ctype_upper($str[$i])) {
             $invoice_code .= $str[$i];
          }
        }
        $order = Order::where('id', $order->id)->with(['orderLineItem', 'brand'])->first()->toArray();
        return view($section->folder.'.show', compact('order', 'section','invoice_logo','today_date','invoice_code'));
    }

    public function create()
    {
        checkPermission('create-order');
        $order = [];
        $section = $this->section;
        $section->heading = 'Invoice';
        $section->title = 'Add New Invoice';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';

        $services = Service::Active(1)->orderBy('sorting_order')->get();
        $brands = Brand::Active(1)->orderBy('sorting_order')->get();
        $users = User::where('user_type',2)->pluck('email', 'email')->toArray();
        $serviceArray = [];
        return view($section->folder.'.form',compact('users','section', 'order', 'services', 'brands', 'serviceArray'));
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', '300');
        $section = $this->section;


        $obj = new \stdClass();
        $obj->from = 'faizan.siddiqui.89@gmail.com';
        $obj->sales = $request->user()->name;

        if($request->customer_type != 0){
        $password = str_random(8);
        $errorMessages = [
            'new_customer_email.unique' => 'Email already exist. Please enter a unique email',
        ];

        $validator = Validator::make($request->all(), [
            'new_customer_email' => 'unique:users,email',
            // 'user_type' => 'required',
            // 'status' => 'required|boolean'
        ], $errorMessages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $user = new User;
            $user->name = $request->first_name.' '.$request->last_name;
            $user->email = $request->new_customer_email;
            $user->password = Hash::make($password);
            $user->is_customer = 1;
            $user->user_type = 2;
            $user->save();
            $obj->subject = 'New User';
            $obj->to = $user->email;
            $obj->customer = $user->name;
            $logo = Brand::where('id',$request->brand)->pluck('picture')->first();

        $data = [
            'user' => $user,
            'password' => $password,
            'logo' => $logo
        ];

          // Mail::send('emails.new_user',$data, function ($message) use ($obj) {
          //       $message->from($obj->from,$obj->sales);
          //       $message->to($obj->to,$obj->customer);
          //       $message->subject($obj->subject);
          //   });

        }

    }

            if ($request->old_customer_email != null) {
              $obj->to =  $request->old_customer_email;
              $obj->customer = User::where('email',$request->old_customer_email)->pluck('name')->first();
            }
            else{
              $obj->to =  $request->new_customer_email;
              $obj->customer = User::where('email',$request->new_customer_email)->pluck('name')->first();
            }

        $request->request->add([
            'order_id'=> Order::latest()->pluck('id')->first() + 1,
            'order_time'=> Carbon::now()->format('Y-m-d H:i:s'),
            'order_date'=> Carbon::now()->format('Y-m-d'),
            'order_status'=> 0,
            'customer_email'=> $request->new_customer_email != null ? $request->new_customer_email : $request->old_customer_email,
            'sale_person'=> $request->user()->id,
            'brand_id'=> $request->brand,
        ]);

        $order = Order::create($request->all());
        foreach ($request->service as $service){
            $item = [
                'order_id' => $order->id,
                'service_name' => $service,
            ];
            OrderLineItem::create($item);
        }

        $data = [
            'order' => $order,
        ];

            $order = Order::with(['orderLineItem', 'brand'])->where('id', $order->id)->first();
            // dd($order->brand->picture);
            $obj->subject = 'New Order';
            $obj->template_id = 'd-3fb884b6895a48e1bdc2ba252127b2a8';

            //Dynamic Data for New Order Mail
            $dynamicData =  [
                'brand_logo' => 'http://127.0.0.1:8000/'.$order->brand->picture,
                'brand_name' => $order->brand->name,
                'pay_link'  => route("order.paynow", Crypt::encrypt($order['id'])),
            ];
            //sendEmail($dynamicData, $obj);

          // Mail::send('emails.new_order',$data, function ($message) use ($obj) {
          //       $message->from($obj->from,$obj->sales);
          //       $message->to($obj->to,$obj->customer);
          //       $message->subject($obj->subject);
          //   });


        // Send Notification of New Order
        $sender = User::find(auth()->user()->id);
        $recipients = User::whereIn('user_type', [1,3])->get(); // To Admin & Owner
        $detailNotify = [
            'description' => $sender->name.' has created a new order for '.$order->customer_email,
            'link' => route("order.show", $order ->id),
            'member_id' => [1,3], // To Admin & Owner
            'user_id' => auth()->user()->id
         ];
        foreach($recipients as $recipient){
             User::find($recipient->id)->notify( new newNotification($detailNotify));
        }

        $request->session()->flash('flash_message', 'Record has been added successfully.');
        return redirect()->route($section->slug.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        checkPermission('update-order');
         $section = $this->section;
         $section->heading = 'Invoice';
         $section->title = 'Edit Invoice';
         $section->method = 'PUT';
         $section->route = [$section->slug.'.update', $order];

        $services = Service::Active(1)->orderBy('sorting_order')->get();
        $brands = Brand::Active(1)->orderBy('sorting_order')->get();
        $users = User::whereNotNull('is_customer')->pluck('email','id');
        $order = Order::where('id', $order->id)->with(['orderLineItem'])->first();

        $serviceArray = OrderLineItem::where('order_id', $order->id)->pluck('service_name')->toArray();

//        dd($order->toArray(),  $services->pluck('name'), $serviceArray);
        return view($section->folder.'.form', compact('users','order', 'section', 'services', 'brands', 'serviceArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // $this->checkPermission('update-order');
        // dd($request->all());
        $section = $this->section;
        $order->update($request->all());

        OrderLineItem::where('order_id', $order->id)->delete();
        foreach ($request->service as $service){
            $item = [
                'order_id' => $order->id,
                'service_name' => $service,
            ];
            OrderLineItem::create($item);
        }
        $request->request->add(['terms' => nl2br($request->terms)]);

        // Send Notification of Order Update
        $sender = User::find(auth()->user()->id);
        $recipients = User::whereIn('user_type', [1,3])->get(); // To Admin & Owner
        $detailNotify = [
            'description' => $sender->name.' has updated order of '.$order->customer_email,
            'link' => route("order.show", $order ->id),
            'member_id' => [1,3], // To Admin & Owner
            'user_id' => auth()->user()->id
         ];
        foreach($recipients as $recipient){
             User::find($recipient->id)->notify( new newNotification($detailNotify));
        }

        $request->session()->flash('alert-success', 'Order has been updated successfully.');
        return redirect()->route($section->slug . '.index');
    }

    public function paynow(Request $request, $order_id)
    {

        $order_id = Crypt::decrypt($order_id);

        $section = $this->section;
        $section->heading = 'Invoice';
        $section->title = 'Edit Invoice';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.payNowUpdate', $order_id];

        $order = Order::where('id', $order_id)->with(['orderLineItem', 'brand'])->first();
        return view($section->folder.'.paynow', compact('order', 'section'));
    }

    public function payNowUpdate(Request $request, Order $order)
    {
        $order = Order::with('user','brand')->where('id', $request->order_id)->first();

        $section = $this->section;

        // Create Stripe Object
        $stripe = Stripe::make(Config::get('services.stripe.secret'));




  try {
          // Create Stripe Token
        $token = $stripe->tokens()->create([
            'card' => [
                'number'    => $request->card_number,
                'exp_month' => $request->expiration_month,
                'exp_year'  => $request->expiration_year,
                'cvc'       => $request->card_cvv
            ],
        ]);

        // Create Stripe Customer
        $customer = $stripe->customers()->create([
            'card' => $token['id'],
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->customer_email,
            'description' => $request->description
        ]);

        // Create Stripe Payment
        $charge = $stripe->charges()->create([
            'customer' => $customer['id'],
            'currency' => $request->currency,
            'amount'   => $request->amount,
        ]);

        }
        catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
        $request->session()->flash('alert-danger', $e->getMessage());
        return redirect()->back();
        }



        $request['payment_status'] = 0;
        $request['card_number'] = str_repeat("*", strlen($request->card_number)-4) . substr($request->card_number, -4);

        $order->update($request->all());

        // Send Notification of Payment Success
        $sender = $request->first_name.' '.$request->last_name;
        $recipients = User::whereIn('user_type', [1,3,4,5])->get(); // To Admin,Owner,Sales,Bidder

        $userID = ((auth()->user() && auth()->user()->id) ? auth()->user()->id : 0);
        if(auth()->user() && auth()->user()->id){
            $detailNotify = [
                'description' => $sender.' has paid for an Order',
                'link' => route("order.show", $order ->id),
                'member_id' => [1,3,4,5], // To Admin,Owner,Sales,Bidder
                'user_id' => auth()->user()->id
            ];
        }
        else {
            $detailNotify = [
                'description' => $sender.' has paid for an Order',
                'link' => route("order.show", $order ->id),
                'member_id' => [1,3,4,5], // To Admin,Owner,Sales,Bidder
                'user_id' => 0,
                'user_name' => $sender
            ];
        }

        foreach($recipients as $recipient){
             User::find($recipient->id)->notify( new newNotification($detailNotify));
        }


        $data = [
            'order' => $order,
        ];


        $obj = array();
        $obj["to"] = $request->customer_email;
        $obj["customer"] = $request->first_name.' '.$request->last_name;
        $obj["from"] = $order->user->email;
        $obj["sales"] = $order->user->name;
        $obj["subject"] = 'Payment Successful!!';
        //$obj["template_id"] = 'd-df07f8fcaf9c41ffbc5dbb34782d8ce7';*/





        //Dynamic Data for New Order Mail
        /*$dynamicData =  [
            'brand_logo' => 'http://127.0.0.1:8000/'.$order->brand->picture,
            'brand_name' => $order->brand->name,
        ]; */

     if($order->send_invoice != 0 ){
             $fileName = time().'.pdf';
             $filePath = public_path('/temp_files/').$fileName;
            //  Mail::send('emails.payment_success',$data, function ($message) use ($obj, $order, $fileName) {
            //     $message->from($obj->from,$obj->sales);
            //     $message->to($obj->to,$obj->customer);
            //     $message->subject($obj->subject);
                $invoice_logo = file_get_contents(public_path($order->brand->picture));
                $invoice_logo = base64_encode($invoice_logo);
                $str = $order->brand->name;
                $invoice_code = null;
                for ($i=0; $i <  strlen($str) ; $i++) {
                  if (ctype_upper($str[$i])) {
                     $invoice_code .= $str[$i];
                  }
                }
                $today_date = Carbon::now()->format('M d, Y');
                $pdf = PDF::loadView('invoices.order', compact('order','invoice_logo','invoice_code','today_date'))->save($filePath);
            //     $message->attach($fileName);
            // });

            $attachment = [
                'filePath' => base64_encode(file_get_contents($filePath)),
                'fileName' => $fileName
            ];




            Mail::send('emails.payment_success',$data, function ($message) use ($obj,$filePath,$fileName) {
                     $message->from($obj['from'],$obj['sales']);
                     $message->to($obj['to'],$obj['customer']);
                     $message->subject($obj['subject']);
                    $message->attachData($filePath, $fileName);

             });



            //sendEmail($dynamicData, $obj, $attachment);
            unlink($filePath);

        }else{
            //sendEmail($dynamicData, $obj);

           // dd($obj);

           Mail::send('emails.payment_success',$data, function ($message) use ($obj) {
                 $message->from($obj['from'],$obj['sales']);
                 $message->to($obj['to'],$obj['customer']);
                 $message->subject($obj['subject']);
             });
        }

        $order_id = Crypt::encrypt($request->order_id);
        $request->session()->flash('alert-success', 'Order has been completed successfully.');
        return redirect()->route($section->slug . '.paynowThankyou', $order_id);
    }

    public function downloadInvoice($orderID){
        $order = Order::with('user','brand')->where('id', $orderID)->first();
        $invoice_logo = file_get_contents(public_path($order->brand->picture));
        $invoice_logo = base64_encode($invoice_logo);
        $str = $order->brand->name;
        $invoice_code = null;
        for ($i=0; $i <  strlen($str) ; $i++) {
          if (ctype_upper($str[$i])) {
             $invoice_code .= $str[$i];
          }
        }
        $today_date = Carbon::now()->format('M d, Y');
        $pdf = PDF::loadView('invoices.order', compact('order','invoice_logo','invoice_code','today_date'));
        return $pdf->download(time().'.pdf');
    }

    public function paynowThankyou($orderID)
    {
        $order_id = Crypt::decrypt($orderID);
        $section = $this->section;
        // $section->heading = 'Thanks';
        // $section->title = 'Thank You';
        // $section->method = 'PUT';
        // $section->route = [$section->slug.'.update', $orderID];

        // $services = Service::Active(1)->orderBy('sorting_order')->get();
        // $brands = Brand::Active(1)->orderBy('sorting_order')->get();
        // $logo = Brand::where('id',$request->brand)->pluck('picture')->first();

        $order = Order::with('brand')->where('id', $order_id)->first();

        // $serviceArray = OrderLineItem::where('order_id', $order->id)->pluck('service_name')->toArray();
        return view($section->folder.'.paynow_thankyou', compact('order'));
    }

    // public function orderComplete(Request $request, $order_id)
    // {
    //     $section = $this->section;
    //     $order = Order::where('id', $order_id)->first();
    //     $request->request->add(['order_status'=> 1]);
    //     $order->update($request->all());
    //     $request->session()->flash('alert-success', 'Order has been completed successfully.');
    //     return redirect()->route($section->slug . '.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Request $request, Order $order)
//    {
//        $section = $this->section;
//        $request->request->add(['order_status'=> 2]);
//        $order->update($request->all());
//         request()->session()->flash('alert-success', 'Order has been cancelled successfully.');
//         return redirect()->route($section->slug.'.index');
//    }

    public function checkNewOrder(Request $request) {
        $orders = Order::where('flag', 0)->get();
//        dd($orders->toArray());
        return response()->json($orders->toArray());
    }

    public function sendEmailInvoice(Request $request, $id)
    {

        $order = Order::where('id', $id)->with(['orderLineItem', 'brand'])->first()->toArray();
        dd($request->toArray(), $id, $order);

//        if($busRecords->count() >= 0){
//            // Create PDF for Insurer Sending Start
//            $count = 1;
//            $pdfHtml = '<table class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
//            $pdfHtml .= '<thead>';
//            $pdfHtml .= '<tr>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">S.No</th>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">Passenger Detail</th>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">Next of Kin Detail</th>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">Travelling Detail</th>';
////            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">No of Passenger</th>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">Policy Detail</th>';
//            $pdfHtml .= '<th style="background: #ccc; padding: 10px 5px; border: 1px solid #b1b1b1;">Bus Detail</th>';
//            $pdfHtml .= '</tr>';
//            $pdfHtml .= '</thead>';
//            $pdfHtml .= '<tbody>';
//            foreach ($busRecords as $busRecord){
//                $pdfHtml .= '<tr style="background: #f4f6f9;">';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;">'.$count.'</td>';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Name: </strong>'.$busRecord->passenger_name.'<br/><strong>Number: </strong>'.$busRecord->passenger_contact_number.'<br/><strong>CNIC: </strong>'.$busRecord->passenger_cnic.'</td>';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Name: </strong>'.$busRecord->next_of_kin_name.'<br/><strong>Number: </strong>'.$busRecord->next_of_kin_number.'</td>';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Ticket Number: </strong>'.$busRecord->ticket_number.'<br/><strong>City From: </strong>'.$busRecord->city_from_name.'<br/><strong>Destination City: </strong>'.$busRecord->city_to_name.'</td>';
////                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Ticket Number: </strong>'.$busRecord->ticket_number.'</td>';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Policy Type: </strong>'.$busRecord->policy_type_name.'<br/><strong>Amount: </strong>'.config('main.currency_type.is_default').' '.$busRecord->policy_amount.'</td>';
//                $pdfHtml .= '<td style="padding: 3px 5px;border: 1px solid #c1c5cc;"><strong>Transporter: </strong>'.$busRecord->transporter_name.'<br/><strong>Bus Date: </strong>'.$busRecord->bus_date.'<br/><strong>Departure Time: </strong>'.$busRecord->bus_time.'</td>';
//                $pdfHtml .= '</tr>';
//                $count ++;
//            }
//            $pdfHtml .= '</tbody>';
//            $pdfHtml .= '</table>';
//
//            echo $pdfHtml;
//
//            // Generate PDF and save on storage path
//            $pdf = App::make('dompdf.wrapper');
//            $pdf->loadHTML($pdfHtml)->setPaper('a4', 'landscape')->save(storage_path('invoices/invoice_insurer.pdf'));
//
//            // Create PDF for Insurer Sending End
//            $transporter = Transporter::where('id', $busRecords[0]->transporter_id)->first();
////            $bus_detail = TransporterBuses::with('transporter')->where('id', $bus_id)->first();
//            $insurerDetail = getUserDetail($transporter->insurer_id);
//
//            // Update Booking Status is_report_sent
//            $booking = Bookings::whereIn('id', $busRecords->pluck('id'))->update(array('is_report_sent' => 1));
//
//            // Old work:: bus wise fetch data
//            // Update Terminal Report is_bus_departure
//            //TransporterBusesTerminals::where('bus_id', $bus_id)->where('city_id', auth()->user()->city_id)->update(['is_bus_departure' => 1]);
//
////            $transporter = Transporter::where('id', $bus_detail->transporter_id)->first();
////            dd($transporter->toArray());
//            /*
//             * SEND GRID EMAIL SENT WORK CLOSE TEMPORARY
//            // Sent Email
//            $email = new Mail();
//            $email->setFrom(config('mail.from.address'),config('mail.from.name'));
//            $email->setSubject('Insurer Listing');
//            $email->addTo($insurerDetail['email'],$insurerDetail['first_name'] .' '. $insurerDetail['last_name']);
//            $email->addTo('faizan.siddiqui.89@gmail.com','Yaqeen Services');
//            $email->addTo('siddiquizia87@gmail.com','Yaqeen Services');
//            $email->addContent("text/plain", "Kindly find attachment");
//            $file_encoded = base64_encode(file_get_contents(storage_path('invoices/invoice_insurer.pdf')));
//            $email->addAttachment(
//                $file_encoded,
//                "application/pdf",
//                "invoice_insurer.pdf",
//                "attachment"
//            );
////        $email->setTemplateId("d-17c44bc273fb4bd3be86c4355d3aaeb4");
//            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//            try {
//                $response = $sendgrid->send($email);
//            } catch (Exception $e) {
//                echo 'Caught exception: '.  $e->getMessage(). "\n";
//            }
//            */
//
//            $data["email_to"] = $insurerDetail['email'];
//            $data["email_to_name"] = $insurerDetail['first_name'] .' '. $insurerDetail['last_name'];
//            $data["email_cc"] = config('main.insurer_email.email_cc');
//            $data["email_cc_name"] = config('main.insurer_email.email_cc_name');
//            $data["title"] = 'Insurance report of ' .env('APP_NAME'). ' (Time: ' . date('H:s') . ' ' .date('Y-m-d'). ') ' . getCityName(auth()->user()->city_id);
//
//            $files = [
//                storage_path('invoices/invoice_insurer.pdf')
//            ];
//
//            Mail::send('email_sent', $data, function($message)use($data, $files) {
//                $message->to($data["email_to"], $data["email_to_name"])->subject($data["title"]);
//                $message->cc($data["email_cc"], $data["email_cc_name"]);
//
//                foreach ($files as $file){
//                    $message->attach($file);
//                }
//            });
////        dd($bus_detail->toArray(), $bus_detail->transporter->insurer_id, $insurerDetail);
//
//            $request->session()->flash('alert-success', 'Report has been sent successfully.');
//        }
        return redirect()->back();
    }
}
