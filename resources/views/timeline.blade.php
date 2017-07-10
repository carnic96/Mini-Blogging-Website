@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    You are logged in!
                </div>    
                <div class="panel-heading">
                    <a href="<?php echo url('/profile') ?>">
                        <?php echo $user->first_name; ?>
                    </a>
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
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">TimeLine</div>

                <div class="panel-body">
                    @if (session('success')) 
                        <div class="alert alert-success" >{{session('success')}}</div>
                    @endif
                    @if (session('error')) 
                        <div class="alert alert-error" >{{session('error')}}</div>
                    @endif
                    <form method="post" action="{{ url('/savePost') }}" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group col-md-12">
                            <textarea name="post" style="width: 100%" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input class="btn btn-primary" type="submit" name="submit">
                        </div>

                    </form>
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
                            
                            <?php
                            $url = 'like';
                            if($v->likes->where('user_id',$user->id)->count()>0){
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
