<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Categories';
?>
<div class="row">
    <div class="col-sm-3 col-xs-6">
		<div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total</span>
              <span class="info-box-number">90</span>
            </div>
            <!-- /.info-box-content -->
        </div>
	</div>

	<div class="col-sm-3 col-xs-6">
		<div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Disabled</span>
              <span class="info-box-number">4</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
	</div>

	<div class="col-sm-6 col-xs-12">

		<div class="row">
		    <div class="col-sm-6 col-xs-6">
		      
		    </div>
		    <!-- /.col -->
		    <div class="col-sm-6 col-xs-6">
		    <a href="<?= Url::toRoute(['catalog/category/create'])?>">
		    	<div class="description-block border-right">
		    		<span class="icon-button"><i class="ion ion-plus-circled"></i></span>
			        <h5 class="description-text">Add New Category</h5>
			    </div>
             </a>
		      <!-- /.description-block -->
		    </div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-xs-12">
	<div class="box">
	    <div class="box-header">
	      <h3 class="box-title">Catgories</h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
	      <table id="data-categories" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	          <th>Rendering engine</th>
	          <th>Browser</th>
	          <th>Platform(s)</th>
	          <th>Engine version</th>
	          <th>CSS grade</th>
	        </tr>
	        </thead>
	        <tbody>
	        <tr>
	          <td>Trident</td>
	          <td>Internet
	            Explorer 4.0
	          </td>
	          <td>Win 95+</td>
	          <td> 4</td>
	          <td>X</td>
	        </tr>
	        <tr>
	          <td>Trident</td>
	          <td>Internet
	            Explorer 5.0
	          </td>
	          <td>Win 95+</td>
	          <td>5</td>
	          <td>C</td>
	        </tr>
	        <tr>
	          <td>Trident</td>
	          <td>Internet
	            Explorer 5.5
	          </td>
	          <td>Win 95+</td>
	          <td>5.5</td>
	          <td>A</td>
	        </tr>
	        <tr>
	          <td>Trident</td>
	          <td>Internet
	            Explorer 6
	          </td>
	          <td>Win 98+</td>
	          <td>6</td>
	          <td>A</td>
	        </tr>
	        <tr>
	          <td>Trident</td>
	          <td>Internet Explorer 7</td>
	          <td>Win XP SP2+</td>
	          <td>7</td>
	          <td>A</td>
	        </tr>
	        <tr>
	          <td>Trident</td>
	          <td>AOL browser (AOL desktop)</td>
	          <td>Win XP</td>
	          <td>6</td>
	          <td>A</td>
	        </tr>
	        <tr>
	          <td>Gecko</td>
	          <td>Firefox 1.0</td>
	          <td>Win 98+ / OSX.2+</td>
	          <td>1.7</td>
	          <td>A</td>
	        </tr>
	        <tr>
	          <td>Gecko</td>
	          <td>Seamonkey 1.1</td>
	          <td>Win 98+ / OSX.2+</td>
	          <td>1.8</td>
	          <td>A</td>
	        </tr>
	        </tbody>
	        <tfoot>
	        <tr>
	          <th>Rendering engine</th>
	          <th>Browser</th>
	          <th>Platform(s)</th>
	          <th>Engine version</th>
	          <th>CSS grade</th>
	        </tr>
	        </tfoot>
	      </table>
	    </div>
	    <!-- /.box-body -->
	</div>
	<!-- /.box -->
	</div>
</div>