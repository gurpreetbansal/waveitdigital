<div id="cancel-feedback" class="uk-flex-top" uk-modal>
	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical px-0">
		<div class="custom-scroll">
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<h3><figure><i class="fa fa-file"></i></figure>Feedback</h3>
			<form>	
				@csrf
				<div class="form-group" id="cancel_type">
					<label class="form-label">I would like to cancel my subscription because</label>
					<label><input type="radio" name="cancel_reason" value="1"> Expensive for me</label>
					<label><input type="radio" name="cancel_reason" value="2"> Not required at the moment</label>
					<label><input type="radio" name="cancel_reason" value="3"> Need additional features</label>
					<label><input type="radio" name="cancel_reason" value="4"> Other</label>
					<input type="text" class="form-control other-text">
				</div>

				<div class="form-group">
					<label class="form-label">Overall Rating</label>
					<div class="uk-flex" id="interface_rating">
						<label>Interface</label>
						<div class="interface-rating">
							<input type="hidden" class="interface-rating-value" value="0">
							<span class="star" name="1">&#9733;</span> 
							<span class="star" name="2">&#9733;</span> 
							<span class="star" name="3">&#9733;</span> 
							<span class="star" name="4">&#9733;</span> 
							<span class="star" name="5">&#9733;</span> 
						</div>
					</div>
					<div class="uk-flex" id="feature_rating">
						<label>Features</label>
						<div class="features-rating">
							<input type="hidden" class="features-rating-value" value="0">
							<span class="star" name="1">&#9733;</span> 
							<span class="star" name="2">&#9733;</span> 
							<span class="star" name="3">&#9733;</span> 
							<span class="star" name="4">&#9733;</span> 
							<span class="star" name="5">&#9733;</span> 
						</div>
					</div>
					<div class="uk-flex" id="user_friendly_rating">
						<label>User-friendly</label>
						<div class="user-friendly-rating">
							<input type="hidden" class="user-friendly-rating-value" value="0">
							<span class="star" name="1">&#9733;</span> 
							<span class="star" name="2">&#9733;</span> 
							<span class="star" name="3">&#9733;</span> 
							<span class="star" name="4">&#9733;</span> 
							<span class="star" name="5">&#9733;</span> 
						</div>
					</div>
				</div>

				<div class="text-left btn-group start">           
					<button class="btn blue-btn" type="button" id="submit-feedback-button">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>