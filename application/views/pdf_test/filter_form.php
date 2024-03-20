<!-- application/views/filter_form.php -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Filter Form</title>
</head>

<body>
	<h2>Filter Form</h2>
	<form action="<?= base_url('reportcontroller/generatepdf') ?>" method="post">
		<label for="start_date">Start Date:</label>
		<input type="date" name="start_date" required>

		<label for="end_date">End Date:</label>
		<input type="date" name="end_date" required>

		<label for="jenis_data">Jenis Data:</label>
		<input type="text" name="jenis_data" required>

		<button type="submit">Generate PDF</button>
	</form>
</body>

</html>