@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">Following</div>
                        <div class="col-md-8">{{$following}}</div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">Followers</div>
                        <div class="col-md-8">{{$followers}}</div>
                    </div>
                    <?php if(!empty($settings->bio)) {?>
                    <div class="row">
                        <div class="col-md-4">Bio</div>
                        <div class="col-md-8">{{$settings->bio}}</div>
                    </div>
                    <?php } if(!empty($settings->location)) {?>
                    <div class="row">
                        <div class="col-md-4">Location</div>
                        <div class="col-md-8">{{$settings->location}}</div>
                    </div>
                    <?php }?>
                </div>


            </div>
            <?php if($ifFollowing) {?>
                <div class="row">
                    <div class="col-md-4 col-offset-4"><input type="button" value="Following" /></div>
                </div>
            <?php }else {?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4"><input type="button" value="Follow" /></div>
            </div>
            <?php }?>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="javascript:void(0)">My Profile</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">First Name</div>
                        <div class="col-md-8"><?php echo $dtl->first_name; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Last Name</div>
                        <div class="col-md-8">{{$dtl->last_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email Id</div>
                        <div class="col-md-8">{{$dtl->email}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Phone Number</div>
                        <div class="col-md-8">{{$dtl->phone_number}}</div>
                    </div>
                        
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <?php 
                if(sizeof($posts) > 0) {
                    foreach ($posts as $k => $v) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo 'By ' . ucwords($v->user->first_name . ' ' . $v->user->last_name);?>
                        </div>
                        <div class="panel-body">
                            <span><?php echo $v->post;?></span>
                        </div>
                        <div class="panel-footer" style="text-align: right; padding:0px 12px;">
                            <?php  echo $v->created_at;?>
                        </div>
                        <div >
                            <?php 
                                echo "<a class='btn btn-large btn-primary'>Like 
                                     <i class='fa fa-heart' aria-hidden='true'></i>
                                     </a>";
                                echo "<br><input type='text' name='term' /><br>
                                     <input type='submit' value='Comment' /> 
                                     </form> <br/> <br>";  
                            ?> 
                        </div>
                    </div>
                    <?php
                    }
                }else {
                    echo 'No Post found.';
                }?>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection