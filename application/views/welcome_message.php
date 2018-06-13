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
					<h1 id="tree">Tree</h1>
				</div>

				<div class="bs-component">
					<?= $tree ?>
				</div>
				<div class="bs-component">
					<code><?= $array_tree ?></code>
				</div>

				<input value="SAVE TO DB" class="btn btn-primary">
			</div>
		</div>
	</div>
	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="tree">Hasil Pengujian</h1>
				</div>

				<div class="bs-component">
					<table class="table table-hover">
						<thead>
						<tr>
							<th scope="col">No</th>
							<?php foreach (end($data_fuzzys)->risk as $item) { ?>
								<th scope="col"><?= $item ?></th>
							<?php } ?>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($pengujian as $key => $datum) { ?>
							<tr>
								<th scope="col"><?= $key + 1 ?></th>
								<?php foreach ($datum as $item) { ?>
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
</div>
<hr>

<?php foreach ($data_fuzzys as $fuzzy) { ?>
	<div class="container" id="<?= $fuzzy->prependName() ?>">

		<h1><?= $fuzzy->name ?></h1>

		<div class="bs-docs-section">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-header">
						<h3 id="tables">Data</h3>
					</div>

					<div class="bs-component">
						<table class="table table-hover">
							<thead>
							<tr>
								<?php foreach (end($fuzzy->data) as $key => $item) { ?>
									<th scope="col"><?= $key ?></th>
								<?php } ?>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($fuzzy->data as $datum) { ?>
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
						<h3 id="tables">Rules</h3>
					</div>

					<div class="bs-component">
						<table class="table table-hover">
							<tbody>
							<?php foreach ($fuzzy->rules as $item) { ?>
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

		<?php if (!$fuzzy->result) { ?>
			<div class="bs-docs-section">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
							<h3 id="tables">Fuzzy</h3>
						</div>

						<div class="">
							<?php foreach ($fuzzy->rules as $a => $rule) { ?>
								<div class="bs-component" style="padding: 20px">
									<table class="table table-hover">
										<thead>
										<tr>
											<th colspan="<?= count($rule["types"]) ?>"><?= $rule["name"] ?></th>
										</tr>
										<tr>
											<?php foreach ($rule["types"] as $item) { ?>
												<th scope="col"><?= $item ?></th>
											<?php } ?>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($fuzzy->fuzzification[$rule["name"]] as $datum) { ?>
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
							<h3 id="tables">Sum Fuzzy</h3>
						</div>

						<div class="">
							<?php foreach ($fuzzy->sum as $a => $perrule) { ?>
								<div class="bs-component" style="padding: 20px">
									<table class="table table-hover">
										<thead>
										<tr>
											<th colspan="5"><?= $fuzzy->rules[$a]["name"] ?></th>
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
												<th scope="col"><?= $fuzzy->rules[$a]["types"][$key] ?></th>
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
							<h3 id="tables">Entrophy</h3>
						</div>

						<div class="bs-component">
							<table class="table table-hover">
								<tbody>
								<?php foreach ($fuzzy->entrophy as $a => $item) { ?>
									<tr>
										<th><?= $fuzzy->rules[$a]["name"] ?></th>
										<?php foreach ($item as $key => $val) { ?>
											<th scope="col"><?= $fuzzy->rules[$a]["types"][$key] ?></th>
											<th scope="col"><?= $val ?></th>
										<?php } ?>
									</tr>
								<?php } ?>
								<tr>
									<th>Total</th>
									<th colspan="6"><?= $fuzzy->globalEntrophy ?></th>
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
							<h3 id="tables">IG</h3>
						</div>

						<div class="bs-component">
							<table class="table table-hover">
								<tbody>
								<?php foreach ($fuzzy->iG as $a => $item) { ?>
									<tr>
										<th><?= $fuzzy->rules[$a]["name"] ?></th>
										<th scope="col"><?= $item ?></th>
									</tr>
								<?php } ?>
								<tr>
									<th>Highest</th>
									<th><?= $fuzzy->chosenRule ?></th>
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
							<h3 id="tables">Node Percentage</h3>
						</div>

						<div class="bs-component">
							<table class="table table-hover">
								<tbody>
								<?php foreach ($fuzzy->rules[$fuzzy->highestIGFrom]["types"] as $a => $rule) { ?>
									<tr>
										<th colspan="3"><?= $rule ?></th>
									</tr>
									<?php foreach ($fuzzy->risk as $b => $r) { ?>
										<tr>
											<th><?= $r ?></th>
											<th><?= $fuzzy->pernode[$b][$a] ?></th>
											<th><?= $fuzzy->pernodePercentage[$b][$a] ?></th>
										</tr>
									<?php } ?>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="bs-docs-section">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-header">
						<h3 id="tables">Result</h3>
					</div>

					<div class="bs-component">
						<table class="table table-hover">
							<tbody>
							<tr>
								<th>Result</th>
								<th><?= $fuzzy->getResult() ?></th>
								<th><a href="#tree">Back to Tree</a></th>
							</tr>
							<?php if (!$fuzzy->result) { ?>

								<?php foreach ($fuzzy->children as $a => $item) { ?>
									<tr>
										<th><a href="#<?= $item->name ?>">Child <?= $a + 1 ?></a></th>
										<th><?= $item->name ?></th>
										<th><?= $item->getResult() ?></th>
									</tr>
								<?php } ?>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php } ?>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong>
	seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
</p>

</body>
</html>
