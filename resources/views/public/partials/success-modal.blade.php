@if(!empty(Session::get('success_donate')))
<script type="text/javascript">
$(function() {
    $('#successModal').modal('show');
});
</script>
@endif

<div id="successModal" class="modal donate-modal fade">
	<div class="modal-dialog modal-confirm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
					<i class="bi bi-check-circle"></i>
				</div>
			</div>
			<div class="modal-body text-center">
                <h4 class="">Tahniah!</h4>
				<p class="fw-light mb-3">Sumbangan anda berjaya!</p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn modal-button" data-bs-dismiss="modal">Alhamdulillah</button>  
                </div>	
			</div>
		</div>
	</div>
</div>     