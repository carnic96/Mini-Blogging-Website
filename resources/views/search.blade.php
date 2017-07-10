@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
		            
                	<div class="panel panel-default">
                    	<div class="panel-body">
                        	<?php
			                    if(sizeof($results) > 0)
		                        {
		                            foreach ($results as $key =>$value)
		                            {   
		                                echo ++$key.'). ';
		                                echo "<a href='".url('profile/' . $value->id)."' title='Title'>".$value->first_name.' '. $value->last_name."</a>";
		                                echo "  |  ".$value->email;
		                                echo "<br />";
		                                echo "<br />";
		                            }
		                        }
		                    ?>
                    	</div>
                	</div>
		            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection