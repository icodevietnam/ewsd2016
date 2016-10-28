<?php if(Session::get('user')[0] == null ) { ?>
	<h4>You do not have permission for do the exams</h4>
<?php } 
	else {
?>
<div class="container">

	<br/>
	<h4>History:</h4>
	<p>Some examinations - Username : <?= Session::get('user')[0]->username ?></p>

	<table class="striped">
        <thead>
          <tr>
              <th data-field="id">Code</th>
              <th data-field="from">From</th>
              <th data-field="to">To</th>
              <th data-field="level">Level</th>
              <th data-field="result">Result</th>
              <th data-field="test">Test</th>
              <th data-field="test">Test</th>
          </tr>
        </thead>
        <tbody>
        	<?php 
				foreach ($listExams as $key => $value) { 
			?>
				<tr>
					<td><?= $value->name ?></td>
					<td><?= $value->date_start ?></td>
					<td><?= $value->date_end ?></td>
					<td><?= $value->level ?></td>
					<td><?= $value->result ?> / <?= $value->total ?></td>
					<td><?= $value->complete == 0 ?"<a href='".DIR."code?code=$value->name' class='btn waves-effect waves-light teal lighten-1'>Continue Exam</a>":"Over Time" ?></td>
					<td><?= $value->complete == 1 ?"<a href='".DIR."review?code=$value->name' class='btn waves-effect waves-light teal lighten-1'>Review</a>":"" ?></td>
				</tr>
			<?php
				}
			?>
        </tbody>
      </table>
</div>
<?php  
	}
?>
<br/>