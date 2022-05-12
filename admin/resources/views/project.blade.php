@extends('layout.app')

@section('content')

<div id="mainDivProject"  class="container  ">
<div class="row">
<div class="col-md-12 p-3">
<button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
<table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Description</th>
    <th class="th-sm">Edit</th>
    <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="Project_table">

  </tbody>
</table>
</div>
</div>
</div>

@endsection

<div class="modal fade" id="addNewProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
				 		<div id="projectAddForm" class="">
				 			<h6 class="my-3">Add New Project</h6>
				    <input id="projectNameAddId" type="text" id="" class="form-control mb-5" placeholder="Project Name" />
				    <input id="projectDescAddId" type="text" id="" class="form-control mb-5" placeholder="Project Desc" />
				     <input id="projectLinkAddId" type="text" id="" class="form-control mb-5" placeholder="Project Link" />
				    <input id="projectImgAddId" type="text" id="" class="form-control mb-5" placeholder="Project Image" />
				  	</div>
				   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="projectAddConfirmBtn" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
      	<h5 class="my-4">Do you want to delete?</h5>
      	<h5 id="projectDeleteId" class="my-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button data-id=" " id="projectDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ProjecteditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-5">

				 		<h5 id="projectEditId" class="my-4"></h5>
				 		
				 		<div id="projectEditForm" class="">

				    <input id="projectNameId" type="text" id="" class="form-control mb-5" placeholder="Project Name" />
				    <input id="projectDescId" type="text" id="" class="form-control mb-5" placeholder="Project Desc" />
				    <input id="projectLinkId" type="text" id="" class="form-control mb-5" placeholder="Project Link" />
				    <input id="projectImgId" type="text" id="" class="form-control mb-5" placeholder="Project Image" />
				  	</div>

				    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="projectEditConfirmBtn" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@section('script')
	<script type="text/javascript">
		getProjectData();




  function getProjectData(){
  axios.get('/getProjectData')
  .then(function(response){
    if(response.status==200){
      $('#ProjectDataTable').DataTable().destroy();
      $('#Project_table').empty();
      var jsonData=response.data;

    $.each(jsonData,function(i,item){
      $('<tr>').html(

        
        "<td>"+jsonData[i].project_name +" <td>"+
        "<td> "+jsonData[i].project_desc+"<td>"+
        "<td> <a class='projectEditBtn' data-id="+jsonData[i].id+" ><i class='fas fa-edit'></i></a><td>"+
        "<td><a class='projectDeleteBtn' data-id="+jsonData[i].id+"  ><i class='fas fa-trash-alt'></i></a> <td>"
        ).appendTo('#Project_table');
    });

    }

    $('.projectDeleteBtn').click(function(){
      var id=$(this).data('id');  
      $('#projectDeleteId').html(id);
      //$('#courseDeleteConfirmBtn').val(id);
      $('#projectDeleteConfirmBtn').attr('data-id',id);
      $('#deleteProjectModal').modal('show');
    })

    $('.projectEditBtn').click(function(){
      var id=$(this).data('id');
      $('#projectEditId').html(id);
      getProjectUpdateDetails(id);
      $('#ProjecteditModal').modal('show');
    })

    
  }) 

  .catch(function(error){

  });
}

$('#addNewProjectBtnId').click(function(){
  $('#addNewProjectModal').modal('show');
})

$('#projectAddConfirmBtn').click(function(){
  var name=$('#projectNameAddId').val();
  var desc=$('#projectDescAddId').val();
  var link=$('#projectLinkAddId').val();
  var img=$('#projectImgAddId').val();

  AddProject(name,desc,link,img);
})


function AddProject(ProjectName,ProjectDesc,ProjectLink,ProjectImg){
  if(ProjectName.length==0){
    
  }
  else if(ProjectDesc.length==0){
    toastr.error('Project Desc is Empty !');
  }
  else if(ProjectLink.length==0){
    toastr.error('Project link is Empty !');
  }
  else if(ProjectImg.length==0){
    toastr.error('Project Img is Empty !');
  }
  else{
    axios.post('/addProject',{
    
    name:ProjectName,
    desc:ProjectDesc,
    link:ProjectLink,
    img:ProjectImg

  })
  .then(function(response){
    if(response.data==1){
      $('#addNewProjectModal').modal('hide');
      getProjectData();
      
    }else{
      $('#addNewProjectModal').modal('hide');
      getProjectData();
    }
    
  })
  .catch(function(error){
    
  });
  }
}


$('#projectDeleteConfirmBtn').click(function(){

  var id = $(this).data('id');
  //var id = $('#courseDeleteConfirmBtn').val(); 
  ProjectDelete(id);

})

function ProjectDelete(deleteId){
  axios.post('/deleteProject',{id:deleteId})
  .then(function(response){ 
    
    if(response.data==1){
      $('#deleteProjectModal').modal('hide');
      getProjectData();
      
    }else{
      $('#deleteProjectModal').modal('hide');
      getProjectData();
    }
  })
  .catch(function(error){

  });
}


function getProjectUpdateDetails(deleteId){
  axios.post('/detailsProject',{id:deleteId})
  .then(function(response){
    if(response.status==200){
      
      var jsonData=response.data;
      $('#projectNameId').val(jsonData[0].project_name);
      $('#projectDescId').val(jsonData[0].project_desc);
      $('#projectLinkId').val(jsonData[0].project_link);
      $('#projectImgId').val(jsonData[0].project_img);
      //alert(jsonData[0].service_name);
    }
    
  })
  .catch(function(error){
    
  });
}


$('#projectEditConfirmBtn').click(function(){
  var id=$('#projectEditId').html();
  var name=$('#projectNameId').val();
  var desc=$('#projectDescId').val();
  var link=$('#projectLinkId').val();
  var img=$('#projectImgId').val();

  ProjectUpdate(id,name,desc,link,img);
})

function ProjectUpdate(projectId,projectName,projectDesc,projectLink,projectImg){
  if(projectId.length==0){
    
  }
  else if(projectName.length==0){
    toastr.error('Project Name is Empty !');
  }
  else if(projectDesc.length==0){
    toastr.error('Project Desc is Empty !');
  }
  else if(projectLink.length==0){
    toastr.error('Project Link is Empty !');
  }
  else if(projectImg.length==0){
    toastr.error('Project Img is Empty !');
  }
  else{
    axios.post('/updateProject',{
    id:projectId,
    name:projectName,
    desc:projectDesc,
    link:projectLink,
    img:projectImg

  })
  .then(function(response){
    if(response.data==1){
      $('#ProjecteditModal').modal('hide');
      getProjectData();
      
    }else{
      $('#ProjecteditModal').modal('hide');
      getProjectData();
    }
    
  })
  .catch(function(error){
    
  });
  }
}

	</script>
@endsection