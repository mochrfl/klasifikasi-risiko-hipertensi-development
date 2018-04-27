<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.css">
	<link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">
	<style type="text/css">
		body {
			font-size: 9px;
		}

		.horizon {
			width: 1110px;
			height: 1110px;
			overflow-y: auto;
			overflow-x: auto;
			transform-origin: right top;
			transform: rotate(90deg) translateX(1110px);
		}

		.horizon > .bs-component {
			transform: rotate(-90deg) translateY(-1110px);
			transform-origin: right top;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Data</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<thead>
						<tr>
							<?php foreach ($data[0] as $key => $item) { ?>
								<th scope="col"><?= $key ?></th>
							<?php } ?>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($data as $datum) { ?>
							<tr>
								<?php foreach ($datum as $key => $item) { ?>
									<th scope="col"><?= $item ?></th>
								<?php } ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Rules</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<tbody>
						<?php foreach ($rules as $item) { ?>
							<tr>
								<th scope="col" rowspan="2"><?= $item["name"] ?></th>
								<?php foreach ($item["types"] as $val) { ?>
									<th scope="col"><?= $val ?></th>
								<?php } ?>
							</tr>
							<tr>
								<?php foreach ($item["threshold"] as $val) { ?>
									<th scope="col"><?= $val ?></th>
								<?php } ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Fuzzy</h1>
				</div>

				<div class="">
					<?php foreach ($fuzzy as $a => $perrule) { ?>
						<div class="bs-component" style="padding: 20px">
							<table class="table table-hover">
								<thead>
								<tr>
									<th colspan="<?= count($rules[$a]["types"]) ?>"><?= $rules[$a]["name"] ?></th>
								</tr>
								<tr>
									<?php foreach ($rules[$a]["types"] as $item) { ?>
										<th scope="col"><?= $item ?></th>
									<?php } ?>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($perrule as $datum) { ?>
									<tr>
										<?php foreach ($datum as $key => $item) { ?>
											<th scope="col"><?= $item ?></th>
										<?php } ?>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Sum Fuzzy</h1>
				</div>

				<div class="">
					<?php foreach ($sum_fuzzy as $a => $perrule) { ?>
						<div class="bs-component" style="padding: 20px">
							<table class="table table-hover">
								<thead>
								<tr>
									<th colspan="5"><?= $rules[$a]["name"] ?></th>
								</tr>
								<tr>
									<th></th>
									<th>all</th>
									<th>rendah</th>
									<th>sedang</th>
									<th>tinggi</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($perrule as $key => $datum) { ?>
									<tr>
										<th scope="col"><?= $rules[$a]["types"][$key] ?></th>
										<?php foreach ($datum as $item) { ?>
											<th scope="col"><?= $item ?></th>
										<?php } ?>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Entrophy</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<tbody>
						<?php foreach ($entrophy as $a => $item) { ?>
							<tr>
								<th><?= $rules[$a]["name"] ?></th>
								<?php foreach ($item as $key => $val) { ?>
									<th scope="col"><?= $rules[$a]["types"][$key] ?></th>
									<th scope="col"><?= $val ?></th>
								<?php } ?>
							</tr>
						<?php } ?>
						<tr>
							<th>Total</th>
							<th colspan="6"><?= $globalEntrophy ?></th>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">IG</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<tbody>
						<?php foreach ($iG as $a => $item) { ?>
							<tr>
								<th><?= $rules[$a]["name"] ?></th>
								<th scope="col"><?= $item ?></th>
							</tr>
						<?php } ?>
						<tr>
							<th>Highest</th>
							<th><?= $rules[$highestIG]["name"] ?></th>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Node Percentage</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<tbody>
						<?php foreach ($pernode as $a => $item) { ?>
							<tr>
								<th colspan="3"><?= $rules[$a]["name"] ?></th>
							</tr>
							<?php foreach ($risk as $b => $r) { ?>
								<tr>
									<th><?= $r ?></th>
									<th><?= $pernode[$b][$a] ?></th>
									<th><?= $pernodeP[$b][$a] ?></th>
								</tr>
							<?php } ?>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Result</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<tbody>
						<tr>
							<th>Result</th>
							<th><?= $result ?></th>
						</tr>
						<?php foreach ($children as $a => $item) { ?>
							<tr>
								<th>Child <?= $a + 1 ?></th>
								<th><?= $item->name ?></th>
								<th><?= $item->getResult() ?></th>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tables">Tree</h1>
				</div>

				<div class="bs-component">
					<?=$tree?>
				</div>
			</div>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong>
		seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
	</p>
</div>

</body>
</html>
