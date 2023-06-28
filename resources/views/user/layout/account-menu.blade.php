<div class="col-md-3 col-sm-4 checkout-steps">
    <h6>Account</h6>
    <div>
        <ul class="account-list">
            <li><a href="{{route('account', Auth::user()->id)}}"> <i class="fa fa-edit"></i> Account Information </a></li>
            <li class="active"><a href="{{route('home.myaccount')}}"> <i class="fa fa-edit"></i> My Account</a></li>                                        
            <li><a href="{{route('home.changepassword', Auth::user()->id)}}"> <i class="fa fa-edit"></i> Change Password</a></li>                          
        </ul>                                
    </div>
</div>