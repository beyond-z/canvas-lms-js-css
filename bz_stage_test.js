try {
	if(location.host.startsWith("staging")) {
		document.body.className += ' bz-is-staging';
		var link = document.createElement("link");
		link.setAttribute("rel", "stylesheet");
		// always points to stage since this is not used on prod
		// anyway.
		link.href = "https://s3.amazonaws.com/canvas-stag-assets/bz_stage_style.css";
		document.querySelector("head").appendChild(link);

		var banner = document.createElement("div");
		banner.setAttribute("id", "bz-staging-banner");
		document.body.appendChild(banner);
		banner.innerHTML = "Test Server";
	}
} catch(e) {
	// errors can be safely ignored; don't want to break the site over this
}
