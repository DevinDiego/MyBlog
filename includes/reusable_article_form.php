<?php if(!empty($errors)): ?>
	<ul>
		<?php foreach($errors as $error): ?>
			<li><?=$error ?></li>
		<?php endforeach; ?>
	</ul> 
<?php endif; ?>

<form method="post">
	<div>
		<label for="title">Title:&nbsp;</label>
		<input type="text" name="title" id="title" placeholder="Title" value="<?=htmlspecialchars($title);?>">
	</div>

	<div>
		<label for="content">Content:&nbsp;</label>
		<textarea name="content" rows="4" cols="40" id="content" placeholder="Article Content"><?=htmlspecialchars($content);?></textarea>
	</div>

	<div>
		<label for="published_at">Date/Time:&nbsp;</label>
		<input type="datetime-local" name="published_at" id="published_at" value="<?=htmlspecialchars($published_at); ?>">
	</div>

	<div>
		<button>Save</button>
	</div>
</form>