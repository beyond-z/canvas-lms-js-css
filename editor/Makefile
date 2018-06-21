all:
	dmd editor.d \
		../../../arsd/web.d ../../../arsd/cgi.d ../../../arsd/jsvar.d ../../../arsd/dom.d ../../../arsd/characterencodings.d ../../../arsd/html.d \
		../../../arsd/color.d ../../../arsd/sha.d \
		../../../arsd/database.d ../../../arsd/sqlite.d \
		../../../arsd/http2.d \
		-version=webd_memory_sessions \
		-version=embedded_httpd_threads -debug -g \
		-debug=arsd_http2 \
		-d
