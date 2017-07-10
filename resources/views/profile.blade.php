@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $dtl->first_name; ?></div>

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

                        <?php
                            $url = 'like';
                            if($v->likes->where('user_id',$dtl->id)->count()>0){
                                $url = 'unlike';
                            }
                            ?>

                            <div class="panel-footer" style="text-align: right; padding:2px 12px;">
                                <a href="<?php echo url('/'.$url.'/'.$v->id); ?>" class='btn btn-small btn-primary' style="padding:0 10px; float:left;">   {{ucfirst($url)}} 
                                   <i class='fa fa-heart' aria-hidden='true'></i>
                                </a> 
                                <span style="float: left;padding: 0 5px;"> {{ $v->likes->count() }} likes</span>

                       <?php  echo Carbon\Carbon::parse($v->created_at)->format('M d, Y');?>
                            </div>


                         <div style="padding:5px 12px;">
                                
                                <?php
                                if (!empty($v->comments))
                                {
                                    foreach($v->comments as $comment)
                                    {?>
                                        <div class="panel-body" style="padding: 0">
                                            <span><?php echo ucwords($v->user->first_name).' : ';?></span>
                                            <span><?php echo $comment->comment;?></span>
                                        </div>
                                    <?php 
                                    }
                                }
                                ?> 
                                <textarea style="width: 100%;" name='term'></textarea><br />
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