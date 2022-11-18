<div class="nk-footer d-print-none">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; <?= date('Y')?>{{ session()->get('system_settings.client_name') }}. Product by <a href="https://mrm-soft.com/" target="_blank">MRMSoft</a>
            </div>
        </div>
    </div>
</div>
<audio id="newOrderRec" src="{{ asset('assets/notification/sound_the_alarm.mp3') }}"></audio>

@push('scripts')
<script>
    $(document).ready(function(){
        $("#sidebarMenu").click(function(){
            $(".nk-sidebar").toggleClass("smallDiv");
            $(".nk-wrap").toggleClass("fullWidthDiv");
        });
    });
    $(document).on('click', '.markRead', function(event) {
       var notifyId = $(this).find('.notifyId').text()
       var url =  '{{ route('readNotify') }}'
       $.ajax({
           url: url,
           type: 'get',
           data: {notifyId: notifyId},
       })
       .done(function() {
           console.log("success");
       })
       .fail(function() {
           console.log("error");
       });
    });

     $(document).on('click', '#markAllRead', function(event) {
       var url =  '{{ route('readAllNotify') }}'
       $.ajax({
           url: url,
           type: 'get',
       })
       .done(function() {
           console.log("success");
       })
       .fail(function() {
           console.log("error");
       });
    });

    setInterval(function(){
       var url =  '{{ route('checkNotify') }}'
        $.ajax({
           url: url,
           type: 'get',
           data: {
                oldCount: $('.nk-notification a').length
            }
       }).done(function(data) {
           $('.nk-notification').html(data.view);
           console.log(data.alert)
           if(data.alert == 1){
             $('#notifyIcon').children('a').find('div').addClass('icon-status icon-status-info')
             document.getElementById('newOrderRec').play();
           }
       })
    }, 5000);

    $(document).on('click', '#notifyIcon a', function(event) {
        $('#notifyIcon').children('a').find('div').removeClass('icon-status icon-status-info')
        document.getElementById('newOrderRec').pause();
    });


</script>
@endpush
