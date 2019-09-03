<div class="compartir-btn">
	<span class="btn bt-primary bg-primary text-white">
		<i class="fa fa-share-alt"></i>
	</span>

	<div class="botones-compartir">
		<a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}" target="_blank">
			<span class="btn bt-primary bg-primary text-white">
				<i class="fa fa-facebook"></i>
			</span>
		</a>

		<a href="https://twitter.com/?status=Me gusta esta página {{ URL::current() }}" target="_blank">
			<span class="btn bt-primary bg-primary text-white">
				<i class="fa fa-twitter"></i>
			</span>
		</a>

		<a href="https://www.linkedin.com/shareArticle?url={{ URL::current() }}" target="_blank">
			<span class="btn bt-primary bg-primary text-white">
				<i class="fa fa-linkedin"></i>
			</span>
		</a>
	</div>

</div>