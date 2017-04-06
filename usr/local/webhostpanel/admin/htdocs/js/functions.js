function chk_quotes(str)
{
	re = /(\'.*\")|(\".*\')/;
	return str.search(re) == -1;
}


function chk_pd_name(dir)
{
	re = /^[0-9a-zA-Z-_.\/]+$/;
	// forbid / and /../ and // and ^./ and ^../  and /./  and /..$ and /.$ and ^.$
	re1 = /(^\/$|\/\.\.\/|\/\/|^\.\/|^\.\.\/|\/\.\/|\/\.\.$|\/\.$|^\.$)/;
	return (dir.search(re) != -1) && (dir.search(re1) == -1);
}

function chk_db_name(db)
{
	re = /^[a-zA-Z]{1}[A-Za-z0-9-_]{0,31}$/;
	return db.search(re) != -1;
}

function chk_db_usr_name(usr)
{
	re = /^[a-zA-Z]{1}[A-Za-z0-9_]{0,15}$/;
	return usr.search(re) != -1;
}

function chk_pos_int(pos_int)
{
	re = /^\s*[1-9]{1}[0-9]*\s*$/;
	return pos_int.search(re) != -1;
}

function chk_sys_login(nm)
{
	re = /^[a-zA-Z]{1}[A-Za-z0-9_-]{0,15}$/;
	return nm.search(re) != -1;
}

function chk_mn(mail_name)
{
	re = /^[\w-\+]+((\.)[\w-\+]+)*$/;
	return mail_name.search(re) != -1;
}


function chk_resp_name(resp_name)
{
	re = /^[\.\w\s]+$/;
	return resp_name.search(re) != -1;
}



function chk_login(login)
{
	re = /^[a-zA-Z0-9]{1}[A-Za-z0-9_.-]{0,19}$/;
	return login.search(re) != -1;
}

function chk_realm(realm)
{
	re = /^[^\"]*$/;
	return realm.search(re) != -1;
}

function chk_dom(dom_name)
{
	nore = /\.$/;
	re = /^[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*(\.[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*)+$/;
	return (dom_name.search(nore) == -1) && (dom_name.search(re) != -1);
}

function chk_email(email)
{
	re = /^([^\@]+){1}\@([^\@]+){1}$/;
	found = email.match(re);
	if (!found)
		return false;
	return chk_mn(found[1]) && chk_dom(found[2]);
}

function chk_url(url)
{
	re = /^((http[s]?|ftp):\/\/)?([^\/:]+)(:\d{1,5})?(\/[^\s\"\'`]*)?$/i;
	found = re.exec(url);
	if (!found) 
		return false;

	return chk_dom(found[3]);
}

function chk_ip(ip)
{
	re = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	found = ip.match(re);
	if (!found)
		return false;
	for (i = found.length; i-- > 1;) {
		if ((found[i] < 0) || (found[i] > 255))
			return false;
	}
	return true;
}

function chk_mask(mask)
{
	re = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	found = mask.match(re);
	if (!found)
		return false;
	i = found.length - 1;
	while (i && (found[i] == 0)) i--;
	if (!i)
		return true;
	if (
		(found[i] != 128) &&
		(found[i] != 192) &&
		(found[i] != 224) &&
		(found[i] != 240) &&
		(found[i] != 248) &&
		(found[i] != 252) &&
		(found[i] != 254) &&
		(found[i] != 255)
	)
		return false;
	i--;
	while (i && (found[i] == 255)) i--;

	return i == 0;
}

function dot_to_num(str)
{
	var num = 0;
	var re = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;

	found = str.match(re);
	if (!found)
		return null;
	for (i = 0; ++i < found.length; ) {
		num <<= 8;
		num  |= found[i];
	}
	return num;
}

function chk_ip_mask(ip, mask)
{
	if (!top.chk_ip(ip) || !top.chk_mask(mask))
		return false;

	var num_ip;
	var num_mask;

	if ((num_ip = dot_to_num(ip)) == null)
		return false;

	if ((num_mask = dot_to_num(mask)) == null)
		return false;

	// check ip/mask combination for interface:
	// 1) mask not null
	// 2) host part not null (num_ip & ~num_mask)
	// 3) host part not all 1 ~((num_ip & ~num_mask) | num_mask)
	return num_mask && (num_ip & ~num_mask) && ~((num_ip & ~num_mask) | num_mask);
}

function chk_sys_passwd(username, passwd)
{
	if ((passwd.length < 5) || (passwd.length > 16))
		return false;

	if (passwd.length >= username.length) {
		if (passwd.indexOf(username, 0) != -1)
			return false;
	}

	if ((passwd.indexOf('\'') != -1) || (passwd.indexOf(' ') != -1))
 return false;	for (i = passwd.length; i-- > 0;) {
 if (passwd.charCodeAt(i) > 127)
 return false;
	}	return true;
}


function chk_filename(filename)
{
	re = /^[^\']*$/;
	return filename.search(re) != -1;

}

function chk_uint(uint)
{
	re = /^[0-9]+$/;
	found = uint.match(re);
	if (!found) {
		return false;
	}

	return true;
}


function set_focus(d, el)
{
	if (!el)	// if form element not set - do nothing
		return;

	if ((x = findObj(e, d)) != null) {
		if (x.focus)
			x.focus();
		if (x.select)
			x.select();
	}
}

function syn(s)
{
	if (!s || !s.options || !s.options.length) 
		return false;
	
	if (s.options[s.options.length - 1].selected)
		s.options[s.options.length - 1].selected = false;
}

function cp_scroll(w)
{
	var nav = navigator.appName;
	var ver = parseInt(navigator.appVersion);
	if ((nav.indexOf('Netscape') != -1) && (ver == 4) && w.document.location.hash) {
		var aname = w.document.location.hash.substr(1);
		var an = w.document.anchors[aname];
		if (an)
			w.scrollTo(an.x, an.y);
	}
}