<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=contact'));
    }
?>
<p>
	Scrieți un mesaj și va vom raspunde cât mai curând posibil.
</p>
<form method="post" class="row">
	<fieldset class=" col-lg-4">
		<div class="form-group">
			<label for="contact_name">Numele tău</label>
			<input type="text" class="form-control" name="contact_name" placeholder="Introduceți numele dvs." autofocus required />
		</div>
		<div class="form-group">
			<label for="contact_email">Adresa dvs. de e-mail</label>
			<input type="email" class="form-control" name="contact_email" placeholder="Introduceți emailul dvs." pattern="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" required />
		</div>
		<div class="form-group">
			<label for="contact_topic">Subiect</label>
			<input type="text" class="form-control" name="contact_topic" placeholder=" subiect" required />
		</div>
		<div class="form-group">
			<label for="contact_message">Mesaj</label>
			<textarea name="contact_message"  class="form-control" placeholder=" mesaj" required></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-default" name="contact_submit" value="Trimite" />
		</div>
	</fieldset>
</form>

<div class="bottom">
	<ul class="breadcrumb">
		<li>
			<a href="index.php?page=frontpage">Acasa</a>
		</li>
		<li class="active">
			Contact
		</li>
	</ul>
</div>