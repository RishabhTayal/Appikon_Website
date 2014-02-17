<?
//API implementation to come here

function errorJson($msg){
	print json_encode(array('error'=>$msg));
	exit();
}

function register($user, $pass) {
	//check if username exists
	$login = query("SELECT username FROM login WHERE username='%s' limit 1", $user);
	if (count($login['result'])>0) {
		errorJson('Username already exists');
	}
	 $result = query("INSERT INTO login(username, pass) VALUES('%s','%s')", $user, $pass);
	if (!$result['error']) {
		//success
		login($user, $pass);
	} else {
		//error
		errorJson('Registration failed');
	}
}

function login($user, $pass) {
	$result = query("SELECT IdUser, username FROM login WHERE username='%s' AND pass='%s' limit 1", $user, $pass);
 
	if (count($result['result'])>0) {
		//authorized
		$_SESSION['IdUser'] = $result['result'][0]['IdUser'];
		print json_encode($result);
	} else {
		//not authorized
		errorJson('Authorization failed');
	}
}

function upload($id, $photoData, $title) {
	//check if a user ID is passed
	if (!$id) errorJson('Authorization required');
 
	//check if there was no error during the file upload
	if ($photoData['error']==0) {
		$result = query("INSERT INTO photos(IdUser,title) VALUES('%d','%s')", $id, $title);
		if (!$result['error']) {
 
			//database link
				global $link;
 
				//get the last automatically generated ID
				$IdPhoto = mysqli_insert_id($link);
 
				//move the temporarily stored file to a convenient location
				if (move_uploaded_file($photoData['tmp_name'], "upload/".$IdPhoto.".jpg")) {
					//file moved, all good, generate thumbnail
					thumb("upload/".$IdPhoto.".jpg", 180);
// 					createThumbs("upload/".$IdPhoto.".jpg","upload/".$IdPhoto."-thumb.jpg" , 180);
					print json_encode(array('successful'=>1));
				} else {
					errorJson('Upload on server problem');
				}; 
		} else {
			errorJson('Upload database problem.'.$result['error']);
		}
	} else {
		errorJson('Upload malfunction');
	}
}

function stream($IdPhoto=0) {
	if ($IdPhoto==0) {
		$result = query("SELECT IdPhoto, title, l.IdUser, username FROM photos p JOIN login l ON (l.IdUser = p.IdUser) ORDER BY IdPhoto DESC LIMIT 50");
	} else {
		$result = query("SELECT IdPhoto, title, l.IdUser, username FROM photos p JOIN login l ON (l.IdUser = p.IdUser) WHERE p.IdPhoto='%d' LIMIT 1", $IdPhoto);
	}
 
	if (!$result['error']) {
		print json_encode($result);
	} else {
		errorJson('Photo stream is broken');
	}
}

?>