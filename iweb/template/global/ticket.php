<div class="col-md-12">
	<!--
	<div class="grid support-content">
		<div class="grid-body">


			<div class="row">
				<div class="col-md-12">


					<?php
					if (!empty($_GET['ticket_id']) && $_GET['ticket_id']) {
						$ticket->ticket_id = $_GET['ticket_id'];
					}
					$mentionResult = $ticket->getMentionUser();
					while ($mention = $mentionResult->fetch_assoc()) {
						$mentionDetails = explode(",", $mention['mentioned']);
						$count = 1;
						$comma = '';
						foreach ($mentionDetails as $mentionEmail) {
							if ($mentionEmail) {
								echo $comma . '<button type="button" class="btn btn-outline-secondary rounded-pill">' . $mentionEmail . ' <a id="removeMentionEmail_' . $count . '" data-mention-email="' . $mentionEmail . '" data-ticket-id="' . $_GET['ticket_id'] . '"> <i class="ri-close-circle-line me-1 align-middle font-16"></i></a></button>';
								$comma = ' , ';
								$count++;
							}
						}
					}
					?>

					<ul class="list-group fa-padding">
						<?php
						$ticketResult = $ticket->getTicketDetail();
						$replyCount = 0;
						while ($ticketDetails = $ticketResult->fetch_assoc()) {

							?>
							<?php if ($replyCount == 0) { ?>
								<li class="list-group-item" id="ticketReplyDetails">
									<div class="mt-4 mt-lg-0">



										<button type="button" id="mentionUser" class="btn btn-primary" data-bs-toggle="modal"
											data-ticket-id="<?php echo $_GET['ticket_id']; ?>" data-bs-target="#mentionModal"><i
												class="mdi mdi-plus-circle-outline"></i>
											<?php echo (_lang['add_mention']); ?>
										</button>

										<?php if ($_SESSION["role"] == 'admin') {
											if ($ticketDetails['status'] == 'closed') {
												?>
												<a class="btn btn-warning" title="<?php echo (_lang['make_open']); ?>"
													data-ticket-id="<?php echo $ticketDetails['id']; ?>" id="openTicket">
													<?php echo (_lang['open_ticket']); ?>
												</a>
											<?php } else { ?>
												<a class="btn btn-danger" title="<?php echo (_lang['make_closed']); ?>"
													data-ticket-id="<?php echo $ticketDetails['id']; ?>" id="closeTicket">
													<?php echo (_lang['close_ticket']); ?>
												</a>
											<?php }
										} ?>

										<?php
										if ($ticketDetails['status'] == 'open') {
											?>
											<a class="btn btn-info" data-ticket-id="<?php echo $ticketDetails['id']; ?>"
												data-user-id="<?php echo $_SESSION["user_id"]; ?>" id="ticketReplyButton"
												data-bs-toggle="modal" data-bs-target="#ticketReplyModal" title="Reply to ticket">
												<?php echo (_lang['reply']); ?>
											</a>
										<?php } ?>
									</div>
								</li>
								<li class="list-group-item">
									<div class="media">
										<div class="media-body">
											<div>
												<span class="number pull-right">#
													<?php echo $ticketDetails['id']; ?>
												</span>
												<span style="font-size:26px;padding-bottom:10px;">
													<?php echo $ticketDetails['title']; ?>
												</span>

												<?php
												if ($ticketDetails['status'] == 'open') {
													?>
													<button type="button" class="btn btn-success" data-bs-toggle="tooltip"
														data-bs-placement="top" data-bs-custom-class="success-tooltip"
														data-bs-title="<?php echo (_lang['open_ticket_tip']); ?>">
														<?php echo (_lang['open']); ?>
													</button>
													<?php

												} else if ($ticketDetails['status'] == 'closed') {

													?>
														<button type="button" class="btn btn-danger" data-bs-toggle="tooltip"
															data-bs-placement="top" data-bs-custom-class="danger-tooltip"
															data-bs-title="<?php echo (_lang['closed_ticket_tip']); ?>">
														<?php echo (_lang['closed']); ?>
														</button>
													<?php
												}

												?>
												</span>
											</div>
											<p class="info">
												<?php echo (_lang['opened_by']); ?><a href="#">
													<?php echo $ticketDetails['ticket_creator_name']; ?>
												</a>
												<?php echo $ticket->timeElapsedString($ticketDetails['created']); ?>
												<i class="fa fa-comments"></i>


												<?php echo $ticketDetails["message"]; ?>
											</p>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ($ticketDetails["comments"]) { ?>
								<li class="list-group-item">
									<div class="media">
										<div class="media-body">
											<p class="info">
												<?php echo (_lang['replied_by']); ?> <a href="#">
													<?php echo $ticketDetails['reply_creator_name']; ?>
												</a>
												<?php echo $ticket->timeElapsedString($ticketDetails['reply_date']); ?>
												<i class="fa fa-comments"></i>
												<?php echo $ticketDetails["comments"]; ?>

												<i class="fa fa-comments"></i>
												<?php
												foreach ($ticket->getTicketTags($ticketDetails['reply_id']) as $ticketTagsDetails) {

													echo '<span class="badge bg-secondary  rounded-pill">#' . $ticketTagsDetails . '</span> ';
												}

												?>
											</p>
										</div>
									</div>
								</li>
							<?php } ?>

							<?php
							$replyCount++;
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
					-->



	<div class="row">
		<div class="col-xxl-8 col-xl-7">
			<?php
			if (!empty($_GET['ticket_id']) && $_GET['ticket_id']) {
				$ticket->ticket_id = $_GET['ticket_id'];
			}
			$ticketResult = $ticket->getTicketDetail();
			$replyCount = 0;
			while ($ticketDetails = $ticketResult->fetch_assoc()) {
				if ($replyCount == 0) { 
				?>
				<div class="card d-block">

					<div class="card-body">



						<div class="dropdown card-widgets">
							<a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
								<i class='uil uil-ellipsis-h'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<!-- item-->


								<button type="button" id="mentionUser" class="dropdown-item" data-bs-toggle="modal"
									data-ticket-id="<?php echo $_GET['ticket_id']; ?>" data-bs-target="#mentionModal"><i
										class="mdi mdi-plus-circle-outline"></i>
									<?php echo (_lang['add_mention']); ?>
								</button>


								<li class="list-group-item" id="ticketReplyDetails">
									<?php if ($_SESSION["role"] == 'admin') {
										if ($ticketDetails['status'] == 'closed') {
											?>
											<a class="dropdown-item" title="<?php echo (_lang['make_open']); ?>"
												data-ticket-id="<?php echo $ticketDetails['id']; ?>" id="openTicket">
												<?php echo (_lang['open_ticket']); ?>
											</a>
										<?php } else { ?>
											<a class="dropdown-item" title="<?php echo (_lang['make_closed']); ?>"
												data-ticket-id="<?php echo $ticketDetails['id']; ?>" id="closeTicket">
												<?php echo (_lang['close_ticket']); ?>
											</a>
										<?php }
									} ?>


								</li>
								<!-- item-->

							</div> <!-- end dropdown menu-->
						</div> <!-- end dropdown-->


						<div class="clearfix"></div>



						<h4 class="mt-3">

							<?php
							if ($ticketDetails['status'] == 'open') {
								?>
								<button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top"
									data-bs-custom-class="success-tooltip"
									data-bs-title="<?php echo (_lang['open_ticket_tip']); ?>">
									<?php echo (_lang['open']); ?>
								</button>
								<?php

							} else if ($ticketDetails['status'] == 'closed') {

								?>
									<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-custom-class="danger-tooltip"
										data-bs-title="<?php echo (_lang['closed_ticket_tip']); ?>">
									<?php echo (_lang['closed']); ?>
									</button>
								<?php
							}

							?>
							<?php echo $ticketDetails['title']; ?>


						</h4>

						<div class="row">
							<div class="col-6">
								<!-- assignee -->
								<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">
									<?php echo (_lang['opened_by']); ?>
								</p>
								<div class="d-flex">
									<img src="./itheme/panel/images/users/avatar-1.jpg" alt="Arya S"
										class="rounded-circle me-2" height="24" />
									<div>
										<h5 class="mt-1 font-14">
											<?php echo $ticketDetails['ticket_creator_name']; ?>
										</h5>
									</div>
								</div>
								<!-- end assignee -->
							</div> <!-- end col -->

							<div class="col-6">
								<!-- start due date -->
								<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">#
									<?php echo $ticketDetails['id']; ?>

									



								</p>
								<div class="d-flex">
									<i class='uil uil-schedule font-18 text-success me-1'></i>
									<div>
										<h5 class="mt-1 font-14">
											<?php echo $ticket->timeElapsedString($ticketDetails['created']); ?>
										</h5>
									</div>
								</div>
								<!-- end due date -->
							</div> <!-- end col -->
						</div> <!-- end row -->


						<h5 class="mt-3">
							<?php echo _lang['text']; ?>:
						</h5>

						<p class="text-muted info mb-4">

							<?php echo $ticketDetails["message"]; ?>
						</p>

						<div class="clearfix"></div>
						<?php
									if ($ticketDetails['status'] == 'open') {
										?>
										<a class="btn btn-info" data-ticket-id="<?php echo $ticketDetails['id']; ?>"
											data-user-id="<?php echo $_SESSION["user_id"]; ?>" id="ticketReplyButton"
											data-bs-toggle="modal" data-bs-target="#ticketReplyModal" title="Reply to ticket">
											<?php echo (_lang['reply']); ?>
										</a>
									<?php } ?>

						<!-- start sub tasks/checklists -->
						<h5 class="mt-4 mb-2 font-16">
							<?php echo _lang['mentions']; ?>
						</h5>
						<div class="form-check mt-1">
							<?php $mentionResult = $ticket->getMentionUser();
							while ($mention = $mentionResult->fetch_assoc()) {
								$mentionDetails = explode(",", $mention['mentioned']);
								$count = 1;
								$comma = '';
								foreach ($mentionDetails as $mentionEmail) {
									if ($mentionEmail) {
										echo $comma . '<button type="button" class="btn btn-outline-secondary rounded-pill">' . $mentionEmail . ' <a id="removeMentionEmail_' . $count . '" data-mention-email="' . $mentionEmail . '" data-ticket-id="' . $_GET['ticket_id'] . '"> <i class="ri-close-circle-line me-1 align-middle font-16"></i></a></button>';
										$comma = ' ';
										$count++;
									}
								}
							} ?>
						</div>


						<!-- end sub tasks/checklists -->

					</div> <!-- end card-body-->
				</div>
				<?php } ?>
				<div class="card d-block">
					<?php if ($ticketDetails["comments"]) { ?>
						<div class="card-body">


							<div class="clearfix"></div>



							<div class="row">
								<div class="col-6">
									<!-- assignee -->
									<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">
										<?php echo (_lang['replied_by']); ?>
									</p>
									<div class="d-flex">
										<img src="./itheme/panel/images/users/avatar-1.jpg" alt="Arya S"
											class="rounded-circle me-2" height="24" />
										<div>
											<h5 class="mt-1 font-14">
												<?php echo $ticketDetails['reply_creator_name']; ?>
											</h5>
										</div>
									</div>
									<!-- end assignee -->
								</div> <!-- end col -->

								<div class="col-6">
									<!-- start due date -->
									<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">#
										<?php echo $ticketDetails['reply_id']; ?>
									</p>
									<div class="d-flex">
										<i class='uil uil-schedule font-18 text-success me-1'></i>
										<div>
											<h5 class="mt-1 font-14">
												<?php echo $ticket->timeElapsedString($ticketDetails['reply_date']); ?>
											</h5>
										</div>
									</div>
									<!-- end due date -->
								</div> <!-- end col -->
							</div> <!-- end row -->


							<h5 class="mt-3">
								<?php echo _lang['text']; ?>:
							</h5>

							<p class="text-muted info mb-4">

								<?php echo $ticketDetails["comments"]; ?>
							</p>

							<!-- start sub tasks/checklists -->
							<h5 class="mt-4 mb-2 font-16">
								<?php echo _lang['mentions']; ?>
							</h5>
							<div class="form-check mt-1">
								<?php
								foreach ($ticket->getTicketTags($ticketDetails['reply_id']) as $ticketTagsDetails) {

									echo '<span class="badge bg-secondary  rounded-pill">#' . $ticketTagsDetails . '</span> ';
								}

								?>
							</div>


							<!-- end sub tasks/checklists -->

						</div> <!-- end card-body-->

					<?php } ?>


				</div> <!-- end card-->

				<?php $replyCount++;
			} ?>
<!--
			<div class="card">
				<div class="card-header">
					<h4 class="my-1">
						<?php echo (_lang['comments']); ?> (51)
					</h4>
				</div>
				<div class="card-body">

					<div class="d-flex">
						<img class="me-2 rounded-circle" src="./itheme/panel/images/users/avatar-1.jpg"
							alt="Generic placeholder image" height="32">
						<div class="w-100">
							<h5 class="mt-0">Jeremy Tomlinson <small class="text-muted float-end">5 hours ago</small>
							</h5>
							Nice work, makes me think of The Money Pit.

							<br />
							<a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i
									class="mdi mdi-reply"></i>
								<?php echo _lang['reply']; ?>
							</a>

							<div class="d-flex mt-3">
								<a class="pe-2" href="#">
									<img src="./itheme/panel/images/users/avatar-1.jpg" class="rounded-circle"
										alt="Generic placeholder image" height="32">
								</a>
								<div class="w-100">
									<h5 class="mt-0">Thelma Fridley <small class="text-muted float-end">3 hours
											ago</small></h5>
									i'm in the middle of a timelapse animation myself! (Very different though.) Awesome
									stuff.

									<br />
									<a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2">
										<i class="mdi mdi-reply"></i>
										<?php echo _lang['reply']; ?>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="d-flex mt-3">
						<img class="me-2 rounded-circle" src="./itheme/panel/images/users/avatar-1.jpg"
							alt="Generic placeholder image" height="32">
						<div class="w-100">
							<h5 class="mt-0">Kevin Martinez <small class="text-muted float-end">1 day ago</small></h5>
							It would be very nice to have.

							<br />
							<a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i
									class="mdi mdi-reply"></i>
								<?php echo _lang['reply']; ?>
							</a>
						</div>
					</div>



					<div class="border rounded mt-4">
						<form action="#" class="comment-area-box">
							<textarea rows="3" class="form-control border-0 resize-none"
								placeholder="<?php echo _lang['your_comment']; ?>"></textarea>
							<div class="p-2 bg-light d-flex justify-content-between align-items-center">

								<button type="submit" class="btn btn-sm btn-success"><i
										class='uil uil-message me-1'></i>
									<?php echo _lang['submit']; ?>
								</button>
							</div>
						</form>
					</div> 

				</div> 
			</div>
			end card-->
		</div> <!-- end col -->

		<div class="col-xxl-4 col-xl-5">

			<div class="card">
				<div class="card-body">
					<h5 class="card-title mb-3">
						<?php echo _lang['attachment']; ?>
					</h5>

					<form action="https://coderthemes.com/" method="post" class="dropzone" id="myAwesomeDropzone"
						data-plugin="dropzone" data-previews-container="#file-previews"
						data-upload-preview-template="#uploadPreviewTemplate">
						<div class="fallback">
							<input name="file" type="file" />
						</div>

						<div class="dz-message needsclick">
							<i class="h3 text-muted ri-upload-cloud-2-line"></i>
							<h4>
								<?php echo _lang['drop_file_note1']; ?>
							</h4>
						</div>
					</form>

					<!-- Preview -->
					<div class="dropzone-previews mt-3" id="file-previews"></div>





					<!--

					<div class="card mb-0 shadow-none border">
						<div class="p-2">
							<div class="row align-items-center">
								<div class="col-auto">
									<div class="avatar-sm">
										<span class="avatar-title text-bg-secondary rounded">
											.MP4
										</span>
									</div>
								</div>
								<div class="col ps-0">
									<a href="javascript:void(0);" class="text-muted fw-bold">Admin-bug-report.mp4</a>
									<p class="mb-0">7.05 MB</p>
								</div>
								<div class="col-auto">
									 Button 
									<a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
										<i class="ri-download-2-line"></i>
									</a>
								</div>
							</div>
						</div>
					</div>

					-->

				</div>
			</div>
		</div>
	</div>
	<!-- end row -->










	<div class="modal fade" id="ticketReplyModal" tabindex="-1" role="dialog" aria-labelledby="ticketReply"
		aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header text-bg-primary border-0">
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<form id="replyForm" method="post" action="">
						<div class="modal-body">
							<div class="form-group">
								<textarea name="message" required class="form-control"
									placeholder="<?php echo (_lang['message_ticket_note']); ?>"
									style="height: 120px;"></textarea>
							</div>
							<div class="form-group">
								<select required class="select2 form-control select2-multiple" data-toggle="select2"
									multiple="multiple" name="tags[]"
									data-placeholder="<?php echo (_lang['choose_tag']); ?>" >
									<?php
									$tagResult = $ticket->getTags();
									while ($tagDetails = $tagResult->fetch_assoc()) {
										?>
										<option value="<?php echo $tagDetails['id']; ?>">
											<?php echo $tagDetails['tag_name']; ?>
										</option>
									<?php } ?>

								</select>
							</div>
						</div>
						<div class="modal-footer">
							<input name="ticketId" id="ticketId" type="hidden"
								value="<?php echo ($_GET['ticket_id']); ?>">
							<input name="userId" id="userId" type="hidden"
								value="<?php echo ($_SESSION["user_id"]); ?>">
							<input name="action" id="action" type="hidden" value="replyTicket">
							<button type="submit" class="btn btn-default" data-dismiss="modal"><i
									class="fa fa-times"></i>
								<?php echo (_lang['close']); ?>
							</button>
							<button type="submit" id="save" class="btn btn-primary pull-right"><i
									class="fa fa-pencil"></i>
								<?php echo (_lang['reply']); ?>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="mentionModal" tabindex="-1" role="dialog" aria-labelledby="ticketReply"
		aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header text-bg-primary border-0">
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<form id="mentionForm" method="post">
						<div class="modal-body">
							<div class="form-group">
								<input type="email" name="mentionUser" class="form-control"
									placeholder="<?php echo (_lang['enter_email']); ?>"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<input name="mentionTicketId" id="mentionTicketId" type="hidden"
								value="<?php echo ($_GET['ticket_id']); ?>">
							<input name="action" type="hidden" value="mentionUser">
							<button type="submit" class="btn btn-default" data-dismiss="modal"><i
									class="fa fa-times"></i>
								<?php echo (_lang['close']); ?>
							</button>
							<button type="submit" id="save" class="btn btn-primary pull-right"><i
									class="fa fa-pencil"></i>
								<?php echo (_lang['add']); ?>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


</div>