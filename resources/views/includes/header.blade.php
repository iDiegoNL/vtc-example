<div class="header">
    <div class="container">

        <a class="logo" href="{{ route('home') }}">
            <img class="mplogo" src="{{ asset('assets/img/truckersmp-logo-sm.png') }}" alt="TruckersMP Logo">
        </a>

        <div class="topbar">
            <ul class="loginbar pull-right">
                @guest
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li class="topbar-devider"></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="hoverSelector">
                    <span class="label label-default">
                        {{ Auth::user()->name }}
                        <i class="fas fa-angle-down"></i>
                    </span>
                        <ul class="languages accountMenu hoverSelectorBlock">
                            @if(Auth::user()->company()->exists())
                                <li><a href="{{ route('vtc.show', Auth::user()->company_id) }}">My VTC</a></li>
                            @endif
                            <li><a href="{{ route('event-request.index') }}">Request Event</a></li>
                        </ul>
                    </li>
                    <li class="topbar-devider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>


        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-responsive-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fas fa-bars"></span>
        </button>

    </div>

    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
        <div class="container">
            <ul class="nav navbar-nav">

                <li>
                    <a href="https://forum.truckersmp.com">Forum</a>
                </li>


                <li>
                    <a href="https://discord.gg/truckersmp">Discord</a>
                </li>


                <li>
                    <a href="{{ route('vtc.index') }}">VTC</a>
                </li>


                <li>
                    <a href="#">Download</a>
                </li>


                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Guides & Help
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://truckersmp.com/knowledge-base">Knowledge Base</a></li>
                        <li><a href="https://truckersmp.com/support">Support System</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Information
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">News</a></li>
                        <li><a href="#">Server Status</a></li>
                        <li><a href="http://ets2map.com" target="_blank">Realtime Map &nbsp;<i
                                    class="fas fa-external-link"></i></a></li>
                        <li><a href="https://traffic.krashnz.com" target="_blank">Traffic &nbsp;<i
                                    class="fas fa-external-link"></i></a></li>
                        <li><a href="#">Meet the Team</a></li>
                        <li><a href="#">Rules</a></li>
                        <li><a href="https://teespring.com/stores/truckersmp">Merchandise &nbsp;<i
                                    class="fas fa-external-link"></i></a></li>
                        <li><a href="https://truckersmp.com/patreon-wall-of-fame">Patreon Wall of Fame</a></li>
                    </ul>
                </li>

                <li class="dropdown mega-menu-fullwidth">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Administration
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="mega-menu-content disable-icons">
                                <div class="container">
                                    <div class="row equal-height">
                                        <div class="col-md-3 equal-height-in">
                                            <ul class="list-unstyled equal-height-list">
                                                <li><h3>Players</h3></li>
                                                <li><a href="https://truckersmp.com/admin/users"><i
                                                            class="fas fa-fw fa-user"></i> Players List</a></li>
                                                <li><a href="https://truckersmp.com/admin/groups"><i
                                                            class="fas fa-fw fa-users-cog"></i> User Groups</a></li>
                                                <li><a href="https://truckersmp.com/admin/permissions"><i
                                                            class="fas fa-fw fa-lock-alt"></i> Permissions</a></li>
                                                <li><a href="https://truckersmp.com/admin/search"><i
                                                            class="fas fa-fw fa-search"></i> Search</a></li>
                                                <li><a href="https://truckersmp.com/admin/discord"><i
                                                            class="fab fa-fw fa-discord"></i> Discord Search</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/email"><i
                                                            class="fas fa-fw fa-envelope"></i> Email Search</a></li>
                                                <li><a href="https://truckersmp.com/admin/security-policy/latest"><i
                                                            class="fas fa-fw fa-shield-check"></i> Information
                                                        Security
                                                        Policy</a></li>
                                                <li><a href="https://truckersmp.com/admin/game-logs"><i
                                                            class="fas fa-fw fa-history"></i> Game Logs</a></li>
                                                <li>
                                                    <a href="https://truckersmp.com/patreon/index">
                                                        <i class="fab fa-fw fa-patreon"></i> Patreon Members
                                                    </a>
                                                </li>
                                                <hr class="margin-top-20 margin-bottom-20"/>
                                                <li>
                                                    <a href="https://truckersmp.com/recruitment/admin">
                                                        <i class="fas fa-fw fa-user-tie"></i>
                                                        Recruitment
                                                        <span class="badge badge-green rounded-2x">
                                                                0
                                                            </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/admin/translations">
                                                        <i class="fas fa-fw fa-language"></i> Translations
                                                        <span class="badge badge-dark-blue rounded-2x">13</span>
                                                        <span class="badge badge-red rounded-2x">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/support/admin">
                                                        <i class="fas fa-fw fa-headset"></i> Support System
                                                        <span class="badge badge-blue rounded-2x">259</span>
                                                        <span class="badge badge-red rounded-2x">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/event-request/admin">
                                                        <i class="fas fa-fw fa-server"></i> Event Request
                                                        <span class="badge badge-light-green rounded-2x">13</span>
                                                        <span class="badge badge-red rounded-2x">12</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/admin/canned-message">
                                                        <i class="fa fa-fw fa-comment" aria-hidden="true"></i>
                                                        Canned Message System
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/knowledge-base/admin">
                                                        <i class="fas fa-fw fa-book"></i> Knowledge Base System
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/admin/inactivities">
                                                        <i class="fas fa-fw fa-calendar-times"></i> Staff Inactivity
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/admin/vtc">
                                                        <i class="fas fa-truck-moving"></i> Virtual Trucking Company
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 equal-height-in">
                                            <ul class="list-unstyled equal-height-list">
                                                <li><h3>Bans and Punishments</h3></li>
                                                <li><a href="https://truckersmp.com/admin/ban"><i
                                                            class="fas fa-fw fa-ban"></i> Latest Bans</a></li>
                                                <li><a href="https://truckersmp.com/admin/ban/search"><i
                                                            class="fas fa-fw fa-search"></i> Search Bans</a></li>
                                                <li><a href="https://truckersmp.com/reports"><i
                                                            class="fas fa-fw fa-flag"></i> Reports <span
                                                            class="badge badge-blue rounded-2x">5339</span></a></li>
                                                <li>
                                                    <a href="https://truckersmp.com/appeals/adminindex?admin_id=29">
                                                        <i class="fas fa-fw fa-comments"></i> Ban Appeals Assigned
                                                        To Me
                                                        <span class="badge badge-green rounded-2x">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/appeals/adminindex?admin_id=all"><i
                                                            class="fas fa-fw fa-gavel"></i> All Ban Appeals</a></li>
                                                <li><a href="https://truckersmp.com/appeals/pmindex"><i
                                                            class="fas fa-fw fa-clock"></i> Game Manager Appeals</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/ban/create"><i
                                                            class="fas fa-fw fa-ban"></i> Ban Player</a></li>
                                                <li><a href="https://truckersmp.com/feedback"><i
                                                            class="fas fa-fw fa-users-class"></i> Feedback <span
                                                            class="badge badge-orange rounded-2x">199</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 equal-height-in">
                                            <ul class="list-unstyled equal-height-list">
                                                <li><h3>Staff reports</h3></li>
                                                <li><a href="https://truckersmp.com/admin/staff"><i
                                                            class="fas fa-fw fa-list"></i> Staff List</a></li>
                                                <li><a href="https://truckersmp.com/admin/gamereports"><i
                                                            class="fas fa-fw fa-gamepad"></i> Game Reports
                                                        Status</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/team/activity/in-game"><i
                                                            class="fas fa-fw fa-truck-container"></i> Game Report
                                                        Activity</a></li>
                                                <li><a href="https://truckersmp.com/admin/team/activity/bans"><i
                                                            class="fas fa-fw fa-ban"></i> Ban Activity</a></li>
                                                <li><a href="https://truckersmp.com/admin/team/activity/reports"><i
                                                            class="fas fa-fw fa-flag"></i> Report Activity</a></li>
                                                <li><a href="https://truckersmp.com/appeals/open"><i
                                                            class="fas fa-fw fa-gavel"></i> Open Ban Appeals</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/teams"><i
                                                            class="fas fa-fw fa-users"></i> Game Moderation
                                                        Teams</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/teams/activity"><i
                                                            class="fas fa-fw fa-calendar"></i> Game Moderation
                                                        Activity</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/team/activity/feedback"><i
                                                            class="fas fa-fw fa-user-friends"></i> Feedback Activity</a>
                                                </li>
                                                <li>
                                                    <a href="https://truckersmp.com/admin/team/activity/translations"><i
                                                            class="fas fa-fw fa-language"></i> Translation Activity</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 equal-height-in">
                                            <ul class="list-unstyled equal-height-list">
                                                <li><h3>Dev Corner</h3></li>
                                                <li><a href="https://truckersmp.com/admin/crash"><i
                                                            class="fas fa-fw fa-exclamation"></i> Crash Reports</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/servers"><i
                                                            class="fas fa-fw fa-server"></i> Game Servers</a></li>
                                                <li><a href="/horizon"><i class="fas fa-fw fa-chart-area"></i>
                                                        Laravel Horizon</a></li>
                                                <li><a href="https://truckersmp.com/admin/oauth"><i
                                                            class="fas fa-fw fa-unlock-alt"></i> OAuth Clients</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/language"><i
                                                            class="fas fa-fw fa-language"></i> Languages</a></li>
                                                <li><a href="https://truckersmp.com/admin/rules"><i
                                                            class="fas fa-fw fa-shield"></i> Rules</a></li>
                                                <li><a href="https://truckersmp.com/admin/policy"><i
                                                            class="fas fa-fw fa-user-secret"></i> Privacy Policy</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/tos"><i
                                                            class="fas fa-fw fa-file-contract"></i> Terms of Service</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/news"><i
                                                            class="fas fa-fw fa-newspaper"></i> News Manager</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/security-policy"><i
                                                            class="fas fa-fw fa-shield-check"></i> Information
                                                        Security
                                                        Policy</a></li>
                                                <li><a href="https://truckersmp.com/admin/categories"><i
                                                            class="fas fa-fw fa-list-alt"></i> Categories</a></li>
                                                <li><a href="https://truckersmp.com/admin/announcements"><i
                                                            class="fas fa-fw fa-bullhorn"></i> Announcements</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/site-configuration"><i
                                                            class="fas fa-fw fa-cogs"></i> Site Configuration</a>
                                                </li>
                                                <li><a href="https://truckersmp.com/admin/dlcs"><i
                                                            class="fas fa-fw fa-asterisk"></i> DLCs</a></li>
                                                <li><a href="https://truckersmp.com/admin/award"><i
                                                            class="fas fa-fw fa-award"></i> Awards</a></li>
                                                <li><a href="https://truckersmp.com/admin/steamDebug"><i
                                                            class="fab fa-fw fa-steam"></i> Steam API Debug</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li>
                    <i class="search fas fa-search search-btn"></i>
                    <div class="search-open">
                        <form method="get" action="#">
                            <div class="input-group animated fadeInDown">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search for a player...">
                                <span class="input-group-btn">
                                        <button class="btn-u" type="submit">Go</button>
                                    </span>
                            </div>
                        </form>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
