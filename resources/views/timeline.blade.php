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
                    <a href="<?php url('/timeline') ?>">
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
                            <div class="panel-footer" style="text-align: right; padding:0px 12px;">
                                <a class='btn btn-small btn-primary' style="padding:0 10px; float:left;">   Like 
                                   <i class='fa fa-heart' aria-hidden='true'></i>
                                </a>
                                <?php  echo Carbon\Carbon::parse($v->created_at)->format('M d, Y');?>
                            </div>
                            <div >
                                
                                <?php
                                if (!empty($comments))
                                {
                                    foreach($comments as $k => $v)
                                    {?>
                                        <div class="panel-heading">
                                            <?php echo 'By ' . ucwords($v->user->first_name . ' ' . $v->user->last_name);?>
                                        </div>
                                        <div class="panel-body">
                                            <span><?php echo $v->comment;?></span>
                                        </div>
                                    <?php 
                                    }
                                }
                                ?> 
                                <br />

                                <textarea style="width: 100%;" name='term'></textarea><br />
                                <input type='button' value='Comment' /> 
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
