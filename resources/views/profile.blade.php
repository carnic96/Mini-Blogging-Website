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
                 <?php /*    <div class="row">
                        <div class="col-md-4">Bio</div>
                        <div class="col-md-8">{{$settings->bio}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Location</div>
                        <div class="col-md-8">{{$settings->location}}</div>
                    </div> */ ?>
                </div>
            </div>
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
                            <form class="form-horizontal" role="form" method="POST" action="{{      route('destroy') }}">
                            <input type="hidden" name="post_id" value="{{$v->id}}" />
                                {{ csrf_field() }}
                            <?php echo 'By ' . ucwords($v->user->first_name . ' ' . $v->user->last_name); 
                                  echo "<button type='submit' class='btn btn-large btn-primary' style='float: right; padding:0px 12px;'>Delete 
                                     <i class='fa fa-cross' aria-hidden='true'></i>
                                     </button>";
                            ?> 
                            </form>
                        </div>

                        <div class="panel-body">
                            <span><?php echo $v->post;?></span>

                        </div>
                        <div class="panel-footer" style="text-align: right; padding:0px 12px;">
                            <?php  echo Carbon\Carbon::parse($v->created_at)->format('M d, Y');?>
                        </div>
                        <?php if(!empty($v->comments)) {
                            foreach($v->comments AS $comment) {?>
                                <div>{{$comment->comment}}</div>
                        <?php }
                        }?>

                        <div >
                            <?php 
                                echo "<a class='btn btn-large btn-primary'>Like 
                                     <i class='fa fa-heart' aria-hidden='true'></i>
                                     </a>";
                            ?> 
                            <textarea style="width: 100%;" name='comment-{{$v->id}}' id='comment-{{$v->id}}'>
                                
                            </textarea><br />
                            <input type='button' value='Comment' data-post="{{$v->id}}" class="postComment" /> 
                        </div>
                    </div>
                    <?php
                    }
                }else {
                    echo 'No Post found. Make more friends.';
                }?>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection