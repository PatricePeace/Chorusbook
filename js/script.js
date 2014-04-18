function validate(input)
{
	var ok;
	var poste = $('#poste').val();
	if (input.value==0 && poste=='webmaster')
	{
		ok = confirm("L'utilisateur va être supprimé. Etes-vous sûr(e) de vouloir continuer ?");
	}
	else
		ok = 1;
	if (ok)
	{
		$.ajax({
			type:		"post",
			url:		"./valid.php",
			data:		$('#valid').serialize(),
			success:		function(data)
			{
				location.reload();
				if(input.value==0 && poste=='webmaster')
				{
					alert("L'utilisateur a bien été supprimé.");
				}
			},
			error:		function()
			{
				alert("erreur");
			}
		});
	}
}

function verifPW()
{
	var pw = document.getElementsByName('pw')[0];
	var pw2 = document.getElementsByName('pwConfirm')[0];
	if( (pw.value.length < 6) ) 
	{
		pw.className = "input_erreur";
	}
	else if( pw.value != pw2.value)
	{
		pw.className = "input_erreur";
		pw2.className = "input_erreur";
	}
	else
	{
		pw.className = "input_ok";
		pw2.className = "input_ok";
	}
}

function signin()
{
    $.ajax({
	type:		"post",
	url:		"./verifInscription.php",
	data:		$('#signin').serialize(),
	success:	function(data)
	{
		document.getElementById('message').innerHTML = data;
	},
	error:		function()
	{
		alert("La requête n'a pas aboutie.");
	}
    });
}

function check(input)
{
    $.ajax({
	type:		"post",
	url:		"./verifInscription.php",
	data:		"inscription= &single= &"+input.name+"="+input.value,
	success:	function(data)
	{
		if(data == 1)
			input.className = "input_ok";
		else
			input.className = "input_erreur";
	},
	error:		function()
	{
		alert("La requête n'a pas aboutie.");
	}
    });
}

function setProfil()
{
    $.ajax({
	type:		"post",
	url:		"./setProfil.php",
	data:		$('#setProfil').serialize(),
	success:	function(data)
	{
		document.getElementById('message').innerHTML = data;
	}
    });
}

function setPw()
{
    $.ajax({
	type:		"post",
	url:		"./setProfil.php",
	data:		$('#setPw').serialize(),
	success:	function(data)
	{
		document.getElementById('message').innerHTML = data;
	}
    });
}
