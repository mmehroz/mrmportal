@extends('layouts.dashboard')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto">
                        @if( $targets )
                            @foreach( $targets as $teamPersons )
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head"  style="background: #fff; ">
                                        <div class="nk-order-ovwg-data buy">
                                            <div class="amount">{{ getTeamName($teamPersons['team_id'])->name }}</div>
                                            <div class="amount">
                                            @if(getTeamName($teamPersons['team_id'])->team_target <= $teamPersons['team_target'])
                                                <em class="icon ni ni-arrow-up-left"></em>
                                            @else
                                                <em class="icon ni ni-arrow-down-left"></em>
                                            @endif
                                                <small class="currenct currency-usd">Team Earn Amount</small> {!!  getAmountFormat($teamPersons['team_target'])  !!}</div>
                                            <div class="info">Team Target <strong>{!! getAmountFormat(getTeamName($teamPersons['team_id'])->team_target) !!}</strong></div>
                                        </div>
                                    </div>
                                </div>
                        <div class="nk-block nk-block-lg">
                            <div class="row g-gs">
                                @foreach($teamPersons['members'] as $teamPerson)
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="team">
                                                    @if(getUserDetail($teamPerson['member_id'])->status == 1)
                                                        <div class="team-status bg-success text-white"><em class="icon ni ni-check-thick"></em></div>
                                                    @else
                                                        <div class="team-status bg-danger text-white"><em class="icon ni ni-na"></em></div>
                                                    @endif
                                                    <div class="user-card user-card-s2">
                                                        <div class="user-avatar md bg-primary"> </span>
                                                            {!! getUserImage(getUserDetail($teamPerson['member_id'])->id) !!}
                                                        </div>
                                                        <div class="user-info">
                                                            <h6>{{ getUserDetail($teamPerson['member_id'])->name}}</h6> <span class="sub-text">{{ getUserDetail($teamPerson['member_id'])->email}}</span> </div>
                                                    </div>
                                                    {{--                                                        <div class="team-details">--}}
                                                    {{--                                                            <p>I am an UI/UX Designer and Love to be creative.</p>--}}
                                                    {{--                                                        </div>--}}
                                                    <ul class="team-info">
                                                        <li><span>Individual Target</span><span>{!! getAmountFormat(getUserDetail($teamPerson['member_id'])->target_individual) !!}</span></li>
                                                        <li><span>Individual Percentage</span><span>{!! getUserDetail($teamPerson['member_id'])->perc_individual !!} %</span></li>
{{--                                                                <li><span>Team Target</span><span>{!!  getUserDetail($teamPerson['member_id'])->target_team !!}</span></li>--}}
                                                        <li><span>Team Percentage </span><span>{!! getUserDetail($teamPerson['member_id'])->perc_team !!} %</span></li>
                                                    </ul>
                                                    <div class="team-view">
                                                        <a href="#" class="btn btn-block btn-dim btn-primary"><span>Sale Amount {!! getAmountFormat($teamPerson['sale_amount']) !!}</span></a>
                                                    </div>
                                                    @if($teamPerson['sale_amount'] && getUserDetail($teamPerson['member_id'])->target_individual)
                                                        <div class="progress progress-lg">
                                                            <div class="progress-bar" data-progress="{{ number_format($teamPerson['sale_amount'] * 100 / getUserDetail($teamPerson['member_id'])->target_individual) }}">{{ number_format($teamPerson['sale_amount'] * 100 / getUserDetail($teamPerson['member_id'])->target_individual) }}%</div>
                                                        </div>
                                                    @endif

                                                </div>
                                                <!-- .team -->
                                            </div>
                                            <!-- .card-inner -->
                                        </div>
                                        <!-- .card -->
                                    </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="nk-block nk-block-lg">
                            {{-- <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table">
                                        <tbody>
                                        @if( $targets )
                                            @foreach( $targets as $teamPersons )
                                                <tr>
                                                    <td colspan="2"> <strong>{{ getTeamName($teamPersons['team_id'])->name }}</strong> </td>
                                                    <td><strong> Team Amount {{ $teamPersons['team_target'] }}</strong></td>
                                                </tr>

                                                @foreach($teamPersons['members'] as $teamPerson)
                                                <tr>
                                                    <td>{{ getUserDetail($teamPerson['member_id'])->name}}</td>
                                                    <td>Individual Target {{ getUserDetail($teamPerson['member_id'])->target_individual}} <br/>
                                                        Individual Percentage {{ getUserDetail($teamPerson['member_id'])->perc_individual}} <br/>
                                                        Team Target {{ getUserDetail($teamPerson['member_id'])->target_team}} <br/>
                                                        Team Percentage {{ getUserDetail($teamPerson['member_id'])->perc_team}}</td>
                                                    <td>Person Amount {{ $teamPerson['sale_amount'] }}</td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview --> --}}

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="table-bordered  table-condensed   table table-hover  main-table ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Project ID</th>
                                                <th>Milestone</th>
                                                <th>Sale Person</th>
                                                <th>Sale Person Amount</th>
                                                <th>Team</th>
                                                <th>Team Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if( $teamMilestones )
                                            @foreach( $teamMilestones as $teamMilestone )
                                                <tr>
                                                    <td>{{ $teamMilestone['id'] }}</td>
                                                    <td>{{ $teamMilestone['project_id'] }}</td>
                                                    <td>{{ $teamMilestone['milestone'] }}</td>
                                                    <td>{{ getUserDetail($teamMilestone['sale_id'])->name }} - {{ getUserDetail($teamMilestone['sale_id'])->role->name }}</td>
                                                    <td>{{ $teamMilestone['sale_amount'] }}</td>
                                                    <td>{{ getTeamName($teamMilestone['team_id'])->name }}</td>
                                                    <td>{{ $teamMilestone['team_amount'] }}</td>
                                                    <td>
                                                      <div class="btn-group" role="group" aria-label="Basic example">
                                                         {{-- @if(in_array('update-order', getUserPermissions())) --}}
                                                        <a class="btn btn-primary" href='{{ route("project_milestone.edit",  $teamMilestone['id'] ) }}' data-toggle="tooltip" data-placement="top" title="Edit"><em class="icon ni ni-edit-fill"></em></a>
                                                        {{-- @endif --}}

                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });


        $('.start-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '-3d'
            endDate: '1d'
        });
        $('.end-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '1d'
        });
    </script>
@endpush
