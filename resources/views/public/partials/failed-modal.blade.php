@if(!empty(Session::get('failed_donate')))
<script type="text/javascript">
$(function() {
    $('#failedModal').modal('show');
});
</script>
@endif

<div id="failedModal" class="modal donate-modal fade">
	<div class="modal-dialog modal-confirm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
					<i class="bi bi-x-circle"></i>
				</div>
			</div>
			<div class="modal-body text-center">
                <h4 class="">Maaf</h4>
				<p class="fw-light mb-3">Sumbangan anda gagal</p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn modal-button" data-bs-dismiss="modal">Tutup</button>  
                </div>	
			</div>
		</div>
	</div>
</div>     