all:
	dmd -lowmem -m64 editor.d editor_main.d \
		arsd/web.d arsd/cgi.d arsd/jsvar.d arsd/dom.d arsd/characterencodings.d arsd/html.d \
		arsd/color.d arsd/sha.d \
		arsd/database.d arsd/sqlite.d \
		arsd/csv.d \
		arsd/email.d arsd/htmltotext.d \
		arsd/http2.d \
		-version=webd_memory_sessions \
		-version=newer_openssl \
		-d \
		-version=embedded_httpd_threads -debug -g
