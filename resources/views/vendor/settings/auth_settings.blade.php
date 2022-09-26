@extends('layouts.vendor_internal_pages')
@section('content')

<div class="setting-container">
    <div class="white-box pa-0 mb-40">
        <div class="white-box-head">
			<div class="left">
				<div class="heading">
					<img src="{{URL::asset('public/vendor/internal-pages/images/profile-icon.png')}}">
					<h2>Shared Access Settings</h2>
				</div>
			</div>
            <div class="right">
            <a href="javascript:void();" class="btn blue-btn btn-sm" id="AddNewUserBtn"><span uk-icon="icon: user" class="uk-icon"></span><span uk-icon="icon: plus" class="uk-icon" style="width: 10px;height: 10px;margin: 0;position: relative;top: -4px;left: -2px;"></span> Add User</a>
            </div>
		</div>
        <div class="white-box-body no-flex">
            <div class="shared-access-list">
                <table class="border">
                    <tr>
                        <th> Profile Pic</th>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>
                            <figure><img src="{{URL::asset('public/vendor/internal-pages/images/user-img.jpg')}}"></figure>
                        </td>
                        <td>Shruti Dhiman</td>
                        <td>
                            <button type="button" class="btn btn-border blue-btn-border btn-sm">List of projects</button>
                            <div uk-dropdown="pos: right-center">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>shruti.dhiman@imarkinfotech.com</td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:;" class="btn small-btn icon-btn color-blue" uk-tooltip="title:Edit Details; pos: top-center" >
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:;" class="btn small-btn icon-btn color-red" uk-tooltip="title:Delete User; pos: top-center" >
                                    <img src="{{URL::asset('public/vendor/internal-pages/images/delete-icon-small.png')}}">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <figure>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/user-img.jpg')}}">
                            </figure>
                        </td>
                        <td>
                            Acchari Sharma
                        </td>
                        <td>
                            <button type="button" class="btn btn-border blue-btn-border btn-sm">List of projects</button>
                            <div uk-dropdown="pos: right-center">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            acchari.sharma@imarkinfotech.com
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:;" class="btn small-btn icon-btn color-blue" uk-tooltip="title:Edit Details; pos: top-center" >
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:;" class="btn small-btn icon-btn color-red" uk-tooltip="title:Delete User; pos: top-center" >
                                    <img src="{{URL::asset('public/vendor/internal-pages/images/delete-icon-small.png')}}">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <figure>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/user-img.jpg')}}">
                            </figure>
                        </td>
                        <td>
                            Anubha
                        </td>
                        <td>
                            <button type="button" class="btn btn-border blue-btn-border btn-sm">List of projects</button>
                            <div uk-dropdown="pos: right-center">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                    <li><a href="#">Project List here</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            anubha.arora@imarkinfotech.com
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:;" class="btn small-btn icon-btn color-blue" uk-tooltip="title:Edit Details; pos: top-center" >
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:;" class="btn small-btn icon-btn color-red" uk-tooltip="title:Delete User; pos: top-center" >
                                    <img src="{{URL::asset('public/vendor/internal-pages/images/delete-icon-small.png')}}">
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="shared-access-box white-box pa-0" id="AddNewUserBox">
                <div class="white-box-head">
                    <div class="left">
                        <div class="heading">
                            <img src="{{URL::asset('public/vendor/internal-pages/images/add.png')}}">
                            <h2>Add New User</h2>
                        </div>
                    </div>
                </div>
                <div class="white-box-body">
                <form>
                    <div uk-grid>
                        <div class="uk-width-1-3@m">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="uk-width-1-3@m">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="uk-width-1-3@m">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="uk-width-1-3@m">
                            <div class="form-group dropdown">
                                <select class="selectpicker" multiple data-live-search="true">
                                    @if(!empty($projects) && isset($projects))
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->domain_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m">
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="4">View Only(Client)</option>
                                    <option value="3">Addon User (Manager)</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m">
                            <div class="form-group field-group" id="projectlogo-img-section">
                                <div class="form-group file-group">

                                    <label class="custom-file-label">
                                        <input type="file" name="shared_access_image" id="shared_access_image" accept="image/png,image/jpg,image/jpeg" class="shared_access_image">
                                        <div class="custom-file form-control">
                                            <span uk-icon="icon:  upload"></span>
                                            <span id="fileName" class="fileName">User Image</span>
                                            <span>Choose a file or drag it here.</span>
                                            <div class="uploaded-file" id="img-project-logo">
                                                <img id="project_image_preview_container"  alt="logo-img" >
                                            </div>
                                        </div>
                                    </label>
                                    <span class="errorStyle error"><p id="project-logo-error"></p></span>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="create-project-box">
                            <button type="button" disabled class="btn blue-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i>Send Invite</button>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection