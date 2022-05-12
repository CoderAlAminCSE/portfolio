@extends('layout.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewCourseBtnId" type="button" class="btn btn-primary my-3">Add New</button>
<table id="coursesDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr> 
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Details</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>

  <tbody id="courses_table">
  

	
  </tbody>
</table>

</div>
</div>
</div>
@endsection

<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">

       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="courseAddConfirmBtn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body text-center p-3">
      	<h5 class="my-4">Do you want to delete?</h5>
      	<h5 id="courseDeleteId" class="my-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button data-id=" " id="courseDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<h5 id="courseEditId" class="my-4"></h5>
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       		<img id="courseEditLoader" class="loading-icon m-2 " style="height: 60px" src="{{asset('images/spinner.svg')}}">
				    <h5 id="courseEditWrong" class="d-none">Something went wrong</h5>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Cancel</button>
        <button data-id=" " id="courseUpdateConfirmBtn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script type="text/javascript">
			$('#coursesDataTable').DataTable();
			$('.dataTables_length').addClass('bs-select');
	getCoursesData();

		function getCoursesData(){
	axios.get('/getCoursesData')
	.then(function(response){
		if(response.status==200){
			$('#courses_table').empty();
			var jsonData=response.data;

		$.each(jsonData,function(i,item){
			$('<tr>').html(
				"<td>"+jsonData[i].course_name +" <td>"+
				"<td> "+jsonData[i].course_fee+"<td>"+
				"<td> "+jsonData[i].course_totalClass+"<td>"+
				"<td> "+jsonData[i].course_totalEnroll+"<td>"+
				"<td> <a class='courseViewDetailsBtn' data-id="+jsonData[i].id+" ><i class='fas fa-eye'></i></a><td>"+
				"<td> <a class='courseEditBtn' data-id="+jsonData[i].id+" ><i class='fas fa-edit'></i></a><td>"+
				"<td><a class='courseDeleteBtn' data-id="+jsonData[i].id+"  ><i class='fas fa-trash-alt'></i></a> <td>"

				).appendTo('#courses_table');
			
		});

		}


		$('.courseDeleteBtn').click(function(){
			var id=$(this).data('id');
			$('#courseDeleteId').html(id);
			//$('#courseDeleteConfirmBtn').val(id);
			$('#courseDeleteConfirmBtn').attr('data-id',id);
			$('#deleteCourseModal').modal('show');
		})

		$('.courseEditBtn').click(function(){
			var id=$(this).data('id');
			$('#courseEditId').html(id);
			courseUpdateDetails(id);
			$('#updateCourseModal').modal('show');
		})

		
	}) 
	.catch(function(error){

	});
}

$('#addNewCourseBtnId').click(function(){
	$('#addCourseModal').modal('show');
})



$('#courseAddConfirmBtn').click(function(){
	var CourseName=$('#CourseNameId').val();
	var CourseDes=$('#CourseDesId').val();
	var CourseFee=$('#CourseFeeId').val();
	var CourseEnroll=$('#CourseEnrollId').val();
	var CourseClass=$('#CourseClassId').val();
	var CourseLink=$('#CourseLinkId').val();
	var CourseImg=$('#CourseImgId').val();

	 AddCourse(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})

function AddCourse(CourseName,CourseDesc,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){
	if(CourseName.length==0){
		toastr.error('Course Name is Empty !');
	}
	else if(CourseDesc.length==0){
		toastr.error('Course Desc is Empty !');
	}
	else if(CourseFee.length==0){
		toastr.error('Course Fee is Empty !');
	}
	else if(CourseEnroll.length==0){
		toastr.error('Course Enroll is Empty !');
	}
	else if(CourseClass.length==0){
		toastr.error('Course Class is Empty !');
	}
	else if(CourseLink.length==0){
		toastr.error('Course Link is Empty !');
	}
	else if(CourseImg.length==0){
		toastr.error('Course Img is Empty !');
	}
	else{
		axios.post('/addCourses',{
		
		course_name:CourseName,
		course_desc:CourseDesc,
		course_fee:CourseFee,
		course_enroll:CourseEnroll,
		course_class:CourseClass,
		course_link:CourseLink,
		course_img:CourseImg,

	})
	.then(function(response){
		if(response.data==1){
			$('#addCourseModal').modal('hide');
			getCoursesData();
			
		}else{
			$('#addCourseModal').modal('hide');
			getCoursesData();
		}
		
	})
	.catch(function(error){
		
	});
	}
}



/*
$('#courseDeleteConfirmBtn').click(function(){

	var id = $(this).data('id');
	//var id = $('#courseDeleteConfirmBtn').val(); 
	CourseDelete(id);

})
*/

$('#courseDeleteConfirmBtn').click(function(){
   var id= $('#courseDeleteId').html();
   CourseDelete(id);
})

function CourseDelete(deleteId){
	axios.post('/deleteCourses',{id:deleteId})
	.then(function(response){ 
		console.log(response);
		if(response.data==1){
			$('#deleteCourseModal').modal('hide');
			getCoursesData();
			
		}else{
			$('#deleteCourseModal').modal('hide');
			getCoursesData();
		}
	})
	.catch(function(error){

	});
}



function courseUpdateDetails(deleteId){
	axios.post('/detailsCourses',{id:deleteId})
	.then(function(response){
		if(response.status==200){
			//$('#courseEditWrong').removeClass('d-none');
			$('#courseEditLoader').addClass('d-none');

			var jsonData=response.data;
			$('#CourseNameUpdateId').val(jsonData[0].course_name);
			$('#CourseDesUpdateId').val(jsonData[0].course_desc);
			$('#CourseFeeUpdateId').val(jsonData[0].course_fee);
			$('#CourseEnrollUpdateId').val(jsonData[0].course_totalEnroll);
			$('#CourseClassUpdateId').val(jsonData[0].course_totalClass);
			$('#CourseLinkUpdateId').val(jsonData[0].course_link);
			$('#CourseImgUpdateId').val(jsonData[0].course_img);
			//alert(jsonData[0].service_name);
		}else{
			$('#courseEditWrong').removeClass('d-none');
			$('#courseEditLoader').addClass('d-none');
		}
		
	})
	.catch(function(error){
		$('#serviceEditWrong').removeClass('d-none');
		$('#serviceEditLoader').addClass('d-none');
	});
}

$('#courseUpdateConfirmBtn').click(function(){
	var id=$('#courseEditId').html();
	var name=$('#CourseNameUpdateId').val();
	var desc=$('#CourseDesUpdateId').val();
	var fee=$('#CourseFeeUpdateId').val();
	var enroll=$('#CourseEnrollUpdateId').val();
	var classs=$('#CourseClassUpdateId').val();
	var link=$('#CourseLinkUpdateId').val();
	var img=$('#CourseImgUpdateId').val();

	CourseUpdate(id,name,desc,fee,enroll,classs,link,img);
})


function CourseUpdate(courseId,courseName,courseDesc,courseFee,courseEnroll,courseClass,courseLink,courseImg){
	if(courseName.length==0){
		toastr.error('Course Name is Empty !');
	}
	else if(courseDesc.length==0){
		toastr.error('Course Desc is Empty !');
	}
	else if(courseFee.length==0){
		toastr.error('Course Fee is Empty !');
	}
	else if(courseEnroll.length==0){
		toastr.error('Course Enroll is Empty !');
	}
	else if(courseClass.length==0){
		toastr.error('Course Class is Empty !');
	}
	else if(courseLink.length==0){
		toastr.error('Course Link is Empty !');
	}
	else if(courseImg.length==0){
		toastr.error('Course Img is Empty !');
	}
	else{
		axios.post('/updateCourses',{
		id:courseId,
		course_name:courseName,
		course_desc:courseDesc,
		course_fee:courseFee,
		course_enroll:courseEnroll,
		course_class:courseClass,
		course_link:courseLink,
		course_img:courseImg,

	})
	.then(function(response){
		if(response.data==1){
			$('#updateCourseModal').modal('hide');
			getCoursesData();
			
		}else{
			$('#updateCourseModal').modal('hide');
			getCoursesData();
		}
		
	})
	.catch(function(error){
		
	});
	}
}

</script>
@endsection