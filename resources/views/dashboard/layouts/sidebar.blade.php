<div class="app-sidebar-menu">
    <div class="h-100 overflow-y-auto" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/inna-light.png" alt="" height="10">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/inna-biorepo-white.png" alt="" height="50">
                    </span>
                </a>
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/inna-dark.png" alt="" height="10">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/inna-biorepo-red.png" alt="" height="50">
                    </span>
                    
                </a>
            </div>

            <ul id="sidebar-menu">

                <li class="menu-title">Menu</li>

                <li class="{{ Request::is('dashboard') ? 'menuitem-active' : '' }}">
                    <a href="/dashboard" class="tp-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:home"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> Dashboard </span>
                    </a>
                </li>

                <li class="{{ Request::is('dashboard/bioprojects*') ? 'menuitem-active' : '' }}">
                    <a href="/dashboard/bioprojects" class="tp-link {{ Request::is('dashboard/bioprojects*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:list"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> My BioProject </span>
                    </a>
                </li>

                <li class="{{ Request::is('dashboard/biosamples*') ? 'menuitem-active' : '' }}">
                    <a href="/dashboard/biosamples" class="tp-link {{ Request::is('dashboard/biosamples*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:layers-subtract"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> My BioSample </span>
                    </a>
                </li>

                <li class="{{ Request::is('dashboard/bioarchives*') ? 'menuitem-active' : '' }}">
                    <a href="/dashboard/bioarchives" class="tp-link {{ Request::is('dashboard/bioarchives*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:server"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> My BioArchive </span>
                    </a>
                </li>

                <li class="{{ Request::is('dashboard/myrequest*') ? 'menuitem-active' : '' }}">
                    <a href="/dashboard/myrequest" class="tp-link {{ Request::is('dashboard/myrequest*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:file-download"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> My Request </span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/dissem/permission-approval" class="tp-link {{ Request::is('dashboard/dissem/permission-approval*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:checklist"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> Download Request List </span>
                    </a>
                </li>

                <li class="menu-title mt-2">INNAlysis</li>

                <li>
                    <a href="/dashboard/innalysis_galaxy" class="tp-link {{ Request::is('dashboard/innalysis_galaxy*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:tool"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> Galaxy Workflows </span>
                    </a>
                </li>

                @canany(['isSuperAdmin','isAdmin'])
                <li class="menu-title mt-2">Administrator</li>

                <li>
                    <a href="#sidebarAdmin" data-bs-toggle="collapse">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:settings"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ Request::is('dashboard/users*','dashboard/roles*','dashboard/organisms*','dashboard/bioticrels*','dashboard/captures*','dashboard/celularities*','dashboard/centers*','dashboard/affiliates*','dashboard/administratives*','dashboard/consortium*','dashboard/diseases*') ? 'show' : '' }}" id="sidebarAdmin">
                        <ul class="nav-second-level">
                            <li>
                                <a href="/dashboard/users" class="tp-link {{ Request::is('dashboard/users*') ? 'active' : '' }}"><i class="ti ti-point"></i>User</a>
                            </li>
                            <li>
                                <a href="/dashboard/roles" class="tp-link {{ Request::is('dashboard/roles*') ? 'active' : '' }}"><i class="ti ti-point"></i>Role</a>
                            </li>
                            <li>
                                <a href="/dashboard/organisms" class="tp-link {{ Request::is('dashboard/organisms*') ? 'active' : '' }}"><i class="ti ti-point"></i>Organism</a>
                            </li>
                            <li>
                                <a href="/dashboard/bioticrels" class="tp-link {{ Request::is('dashboard/bioticrels*') ? 'active' : '' }}"><i class="ti ti-point"></i>Biotic Relationship</a>
                            </li>
                            <li>
                                <a href="/dashboard/captures" class="tp-link {{ Request::is('dashboard/captures*') ? 'active' : '' }}"><i class="ti ti-point"></i>Capture</a>
                            </li>
                            <li>
                                <a href="/dashboard/celularities" class="tp-link {{ Request::is('dashboard/celularities*') ? 'active' : '' }}"><i class="ti ti-point"></i>Celularities</a>
                            </li>
                            <li>
                                <a href="/dashboard/centers" class="tp-link {{ Request::is('dashboard/centers*') ? 'active' : '' }}"><i class="ti ti-point"></i>Center</a>
                            </li>
                            <li>
                                <a href="/dashboard/affiliates" class="tp-link {{ Request::is('dashboard/affiliates*') ? 'active' : '' }}"><i class="ti ti-point"></i>Affiliate</a>
                            </li>
                            <li>
                                <a href="/dashboard/administratives" class="tp-link {{ Request::is('dashboard/administratives*') ? 'active' : '' }}"><i class="ti ti-point"></i>Administrative</a>
                            </li>
                            <li>
                                <a href="/dashboard/consortium" class="tp-link {{ Request::is('dashboard/consortium*') ? 'active' : '' }}"><i class="ti ti-point"></i>Consortium</a>
                            </li>
                            <li>
                                <a href="/dashboard/diseases" class="tp-link {{ Request::is('dashboard/diseases*') ? 'active' : '' }}"><i class="ti ti-point"></i>Diseases</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcanany

                @cannot('isAuthor')
                <li class="menu-title mt-2">Curator</li>

                <li>
                    <a href="/dashboard/curator/bioprojects" class="tp-link {{ Request::is('dashboard/curator/bioprojects*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:list"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> BioProject </span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/curator/biosamples" class="tp-link {{ Request::is('dashboard/curator/biosamples*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:layers-subtract"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> BioSample </span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/curator/bioarchives" class="tp-link {{ Request::is('dashboard/curator/bioarchives*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:server"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> BioArchive </span>
                    </a>
                </li>
                @endcannot

                @canany(['isOfficer'])
                <li class="menu-title mt-2">Approval Request</li>

                <li>
                    <a href="/dashboard/dissem/permission-approval" class="tp-link {{ Request::is('dashboard/dissem/permission-approval*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <iconify-icon icon="tabler:checklist"></iconify-icon>
                        </span>
                        <span class="sidebar-text"> Download Request List </span>
                    </a>
                </li>
                @endcanany

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
</div>