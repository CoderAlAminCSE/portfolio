@extends('layout.app')
@section('content')


	
<div id="mainDivCourse" class="container">
<div class="row">
<div class="col-md-12 p-5">
	<button id="addNewBtnId" type="button" class="btn btn-primary my-3">Add New</button>
<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>

  <tbody id="service_table">
	
  </tbody>

</table>

</div>
</div>
</div>




@endsection

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
      	<h5 class="my-4">Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button data-id=" " id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-5">

				 		<h5 id="serviceEditId" class="my-4"></h5>
				 		<div id="serviceEditForm" class="d-none">
				    <input id="serviceNameId" type="text" id="" class="form-control mb-5" placeholder="Service Name" />
				    <input id="serviceDescId" type="text" id="" class="form-control mb-5" placeholder="Service Desc" />
				    <input id="serviceImgId" type="text" id="" class="form-control mb-5" placeholder="Service Image" />
				  	</div>
				    <img id="serviceEditLoader" class="loading-icon m-2 " style="height: 60px" src="{{asset('images/spinner.svg')}}">
				    <h5 id="serviceEditWrong" class="d-none">Something went wrong</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="serviceEditConfirmBtn" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
				 		<div id="serviceAddForm" class="">
				 			<h6 class="my-3">Add New Services</h6>
				    <input id="serviceNameAddId" type="text" id="" class="form-control mb-5" placeholder="Service Name" />
				    <input id="serviceDescAddId" type="text" id="" class="form-control mb-5" placeholder="Service Desc" />
				    <input id="serviceImgAddId" type="text" id="" class="form-control mb-5" placeholder="Service Image" />
				  	</div>
				   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="serviceAddConfirmBtn" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@section('script')
	<script type="text/javascript">
			
			$('#serviceDataTable').DataTable({"order":false});
			$('.dataTables_length').addClass('bs-select');
		getServicesData();

		function getServicesData(){
	axios.get('/getServicesData')
	.then(function(response){
		if(response.status==200){
			$('#service_table').empty();
			var jsonData=response.data;

		$.each(jsonData,function(i,item){
			$('<tr>').html(

				"<td><img class='table-img' src="+jsonData[i].service_image+"> <td>"+
				"<td>"+jsonData[i].service_name +" <td>"+
				"<td> "+jsonData[i].service_desc+"<td>"+
				"<td> <a class='serviceEditBtn' data-id="+jsonData[i].id+" ><i class='fas fa-edit'></i></a><td>"+
				"<td><a class='serviceDeleteBtn' data-id="+jsonData[i].id+"  ><i class='fas fa-trash-alt'></i></a> <td>"
				).appendTo('#service_table');
		});

		$('.serviceDeleteBtn').click(function(){
			var id=$(this).data('id');
			$('#serviceDeleteConfirmBtn').attr('data-id',id);
			$('#deleteModal').modal('show');
		})

		

		$('.serviceEditBtn').click(function(){
			var id=$(this).data('id');
			$('#serviceEditId').html(id);
			getServiceUpdateDetails(id);
			$('#editModal').modal('show');
		})

		

		}

		
	}) 

	.catch(function(error){

	});
}


$('#serviceDeleteConfirmBtn').click(function(){
	var id = $(this).data('id');
	getServiceDelete(id);
})

function getServiceDelete(deleteId){
	axios.post('/deleteService',{id:deleteId})
	.then(function(response){
		if(response.data==1){
			$('#deleteModal').modal('hide');
			getServicesData();
			
		}else{
			$('#deleteModal').modal('hide');
			getServicesData();
		}
	})
	.catch(function(error){

	});
}


$('#serviceEditConfirmBtn').click(function(){
	var id=$('#serviceEditId').html();
	var name=$('#serviceNameId').val();
	var desc=$('#serviceDescId').val();
	var img=$('#serviceImgId').val();

	ServiceUpdate(id,name,desc,img);
})

function getServiceUpdateDetails(deleteId){
	axios.post('/detailsService',{id:deleteId})
	.then(function(response){
		if(response.status==200){
			$('#serviceEditForm').removeClass('d-none');
			$('#serviceEditLoader').addClass('d-none');

			var jsonData=response.data;
			$('#serviceNameId').val(jsonData[0].service_name);
			$('#serviceDescId').val(jsonData[0].service_desc);
			$('#serviceImgId').val(jsonData[0].service_image);
			//alert(jsonData[0].service_name);
		}else{
			$('#serviceEditWrong').removeClass('d-none');
			$('#serviceEditLoader').addClass('d-none');
		}
		
	})
	.catch(function(error){
		$('#serviceEditWrong').removeClass('d-none');
		$('#serviceEditLoader').addClass('d-none');
	});
}

function ServiceUpdate(serviceId,serviceName,serviceDesc,serviceImg){
	if(serviceName.length==0){
		
	}
	else if(serviceDesc.length==0){
		toastr.error('Service Desc is Empty !');
	}
	else if(serviceImg.length==0){
		toastr.error('Service Img is Empty !');
	}
	else{
		axios.post('/updateService',{
		id:serviceId,
		name:serviceName,
		desc:serviceDesc,
		img:serviceImg,

	})
	.then(function(response){
		if(response.data==1){
			$('#editModal').modal('hide');
			getServicesData();
			
		}else{
			$('#editModal').modal('hide');
			getServicesData();
		}
		
	})
	.catch(function(error){
		
	});
	}
}


$('#addNewBtnId').click(function(){
	$('#addNewModal').modal('show');
})

$('#serviceAddConfirmBtn').click(function(){
	var name=$('#serviceNameAddId').val();
	var desc=$('#serviceDescAddId').val();
	var img=$('#serviceImgAddId').val();

	AddServices(name,desc,img);
})


function AddServices(serviceName,serviceDesc,serviceImg){
	if(serviceName.length==0){
		
	}
	else if(serviceDesc.length==0){
		toastr.error('Service Desc is Empty !');
	}
	else if(serviceImg.length==0){
		toastr.error('Service Img is Empty !');
	}
	else{
		axios.post('/addService',{
		
		name:serviceName,
		desc:serviceDesc,
		img:serviceImg,

	})
	.then(function(response){
		if(response.data==1){
			$('#addNewModal').modal('hide');
			getServicesData();
			
		}else{
			$('#addNewModal').modal('hide');
			getServicesData();
		}
		
	})
	.catch(function(error){
		
	});
	}
}
		
	</script>
@endsection