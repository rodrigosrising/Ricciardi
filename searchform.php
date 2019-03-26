<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input class="input-group-field" type="search" placeholder="O que procura? ___" value="<?php echo get_search_query(); ?>" name="s" />
		<input type="hidden" name="post_type" value="post" />
		<div class="input-group-button">
			<!-- <input type="submit" class="button secondary" value="Buscar"> -->
			<button type="submit" class="button secondary"><i class="fa fa-search"></i></button>
		</div>
	</div>
</form>