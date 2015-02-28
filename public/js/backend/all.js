(function ($) {


    $('#data').DataTable();


    $('#editor').summernote({height: 300});
    $('#editor_small').summernote({height: 300});

    $("[data-toggle='tooltip']").tooltip();
    $('[data-toggle="popover"]').popover();
    $('#flash-overlay-modal').modal();

})(jQuery);

/*! DataTables Bootstrap 3 integration
 * ©2011-2014 SpryMedia Ltd - datatables.net/license
 */

/**
 * DataTables integration for Bootstrap 3. This requires Bootstrap 3 and
 * DataTables 1.10 or newer.
 *
 * This file sets the defaults and adds options to DataTables to style its
 * controls using Bootstrap. See http://datatables.net/manual/styling/bootstrap
 * for further information.
 */
(function(window, document, undefined){

var factory = function( $, DataTable ) {
"use strict";


/* Set the defaults for DataTables initialisation */
$.extend( true, DataTable.defaults, {
	dom:
		"<'row'<'col-sm-6'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-6'i><'col-sm-6'p>>",
	renderer: 'bootstrap'
} );


/* Default class modification */
$.extend( DataTable.ext.classes, {
	sWrapper:      "dataTables_wrapper form-inline dt-bootstrap",
	sFilterInput:  "form-control input-sm",
	sLengthSelect: "form-control input-sm"
} );


/* Bootstrap paging button renderer */
DataTable.ext.renderer.pageButton.bootstrap = function ( settings, host, idx, buttons, page, pages ) {
	var api     = new DataTable.Api( settings );
	var classes = settings.oClasses;
	var lang    = settings.oLanguage.oPaginate;
	var btnDisplay, btnClass;

	var attach = function( container, buttons ) {
		var i, ien, node, button;
		var clickHandler = function ( e ) {
			e.preventDefault();
			if ( !$(e.currentTarget).hasClass('disabled') ) {
				api.page( e.data.action ).draw( false );
			}
		};

		for ( i=0, ien=buttons.length ; i<ien ; i++ ) {
			button = buttons[i];

			if ( $.isArray( button ) ) {
				attach( container, button );
			}
			else {
				btnDisplay = '';
				btnClass = '';

				switch ( button ) {
					case 'ellipsis':
						btnDisplay = '&hellip;';
						btnClass = 'disabled';
						break;

					case 'first':
						btnDisplay = lang.sFirst;
						btnClass = button + (page > 0 ?
							'' : ' disabled');
						break;

					case 'previous':
						btnDisplay = lang.sPrevious;
						btnClass = button + (page > 0 ?
							'' : ' disabled');
						break;

					case 'next':
						btnDisplay = lang.sNext;
						btnClass = button + (page < pages-1 ?
							'' : ' disabled');
						break;

					case 'last':
						btnDisplay = lang.sLast;
						btnClass = button + (page < pages-1 ?
							'' : ' disabled');
						break;

					default:
						btnDisplay = button + 1;
						btnClass = page === button ?
							'active' : '';
						break;
				}

				if ( btnDisplay ) {
					node = $('<li>', {
							'class': classes.sPageButton+' '+btnClass,
							'aria-controls': settings.sTableId,
							'tabindex': settings.iTabIndex,
							'id': idx === 0 && typeof button === 'string' ?
								settings.sTableId +'_'+ button :
								null
						} )
						.append( $('<a>', {
								'href': '#'
							} )
							.html( btnDisplay )
						)
						.appendTo( container );

					settings.oApi._fnBindAction(
						node, {action: button}, clickHandler
					);
				}
			}
		}
	};

	attach(
		$(host).empty().html('<ul class="pagination"/>').children('ul'),
		buttons
	);
};


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ( DataTable.TableTools ) {
	// Set the classes that TableTools uses to something suitable for Bootstrap
	$.extend( true, DataTable.TableTools.classes, {
		"container": "DTTT btn-group",
		"buttons": {
			"normal": "btn btn-default",
			"disabled": "disabled"
		},
		"collection": {
			"container": "DTTT_dropdown dropdown-menu",
			"buttons": {
				"normal": "",
				"disabled": "disabled"
			}
		},
		"print": {
			"info": "DTTT_print_info"
		},
		"select": {
			"row": "active"
		}
	} );

	// Have the collection use a bootstrap compatible drop down
	$.extend( true, DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );
}

}; // /factory


// Define as an AMD module if possible
if ( typeof define === 'function' && define.amd ) {
	define( ['jquery', 'datatables'], factory );
}
else if ( typeof exports === 'object' ) {
    // Node/CommonJS
    factory( require('jquery'), require('datatables') );
}
else if ( jQuery ) {
	// Otherwise simply initialise as normal, stopping multiple evaluation
	factory( jQuery, jQuery.fn.dataTable );
}


})(window, document);


/*! DataTables 1.10.5
 * ©2008-2015 SpryMedia Ltd - datatables.net/license
 */
(function(Ea,P,k){var O=function(h){function V(a){var b,c,e={};h.each(a,function(d){if((b=d.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(b[1]+" "))c=d.replace(b[0],b[2].toLowerCase()),e[c]=d,"o"===b[1]&&V(a[d])});a._hungarianMap=e}function H(a,b,c){a._hungarianMap||V(a);var e;h.each(b,function(d){e=a._hungarianMap[d];if(e!==k&&(c||b[e]===k))"o"===e.charAt(0)?(b[e]||(b[e]={}),h.extend(!0,b[e],b[d]),H(a[e],b[e],c)):b[e]=b[d]})}function O(a){var b=o.defaults.oLanguage,c=a.sZeroRecords;
!a.sEmptyTable&&(c&&"No data available in table"===b.sEmptyTable)&&E(a,a,"sZeroRecords","sEmptyTable");!a.sLoadingRecords&&(c&&"Loading..."===b.sLoadingRecords)&&E(a,a,"sZeroRecords","sLoadingRecords");a.sInfoThousands&&(a.sThousands=a.sInfoThousands);(a=a.sDecimal)&&db(a)}function eb(a){A(a,"ordering","bSort");A(a,"orderMulti","bSortMulti");A(a,"orderClasses","bSortClasses");A(a,"orderCellsTop","bSortCellsTop");A(a,"order","aaSorting");A(a,"orderFixed","aaSortingFixed");A(a,"paging","bPaginate");
A(a,"pagingType","sPaginationType");A(a,"pageLength","iDisplayLength");A(a,"searching","bFilter");if(a=a.aoSearchCols)for(var b=0,c=a.length;b<c;b++)a[b]&&H(o.models.oSearch,a[b])}function fb(a){A(a,"orderable","bSortable");A(a,"orderData","aDataSort");A(a,"orderSequence","asSorting");A(a,"orderDataType","sortDataType")}function gb(a){var a=a.oBrowser,b=h("<div/>").css({position:"absolute",top:0,left:0,height:1,width:1,overflow:"hidden"}).append(h("<div/>").css({position:"absolute",top:1,left:1,width:100,
overflow:"scroll"}).append(h('<div class="test"/>').css({width:"100%",height:10}))).appendTo("body"),c=b.find(".test");a.bScrollOversize=100===c[0].offsetWidth;a.bScrollbarLeft=1!==c.offset().left;b.remove()}function hb(a,b,c,e,d,f){var g,j=!1;c!==k&&(g=c,j=!0);for(;e!==d;)a.hasOwnProperty(e)&&(g=j?b(g,a[e],e,a):a[e],j=!0,e+=f);return g}function Fa(a,b){var c=o.defaults.column,e=a.aoColumns.length,c=h.extend({},o.models.oColumn,c,{nTh:b?b:P.createElement("th"),sTitle:c.sTitle?c.sTitle:b?b.innerHTML:
"",aDataSort:c.aDataSort?c.aDataSort:[e],mData:c.mData?c.mData:e,idx:e});a.aoColumns.push(c);c=a.aoPreSearchCols;c[e]=h.extend({},o.models.oSearch,c[e]);ka(a,e,h(b).data())}function ka(a,b,c){var b=a.aoColumns[b],e=a.oClasses,d=h(b.nTh);if(!b.sWidthOrig){b.sWidthOrig=d.attr("width")||null;var f=(d.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/);f&&(b.sWidthOrig=f[1])}c!==k&&null!==c&&(fb(c),H(o.defaults.column,c),c.mDataProp!==k&&!c.mData&&(c.mData=c.mDataProp),c.sType&&(b._sManualType=c.sType),
c.className&&!c.sClass&&(c.sClass=c.className),h.extend(b,c),E(b,c,"sWidth","sWidthOrig"),"number"===typeof c.iDataSort&&(b.aDataSort=[c.iDataSort]),E(b,c,"aDataSort"));var g=b.mData,j=W(g),i=b.mRender?W(b.mRender):null,c=function(a){return"string"===typeof a&&-1!==a.indexOf("@")};b._bAttrSrc=h.isPlainObject(g)&&(c(g.sort)||c(g.type)||c(g.filter));b.fnGetData=function(a,b,c){var e=j(a,b,k,c);return i&&b?i(e,b,a,c):e};b.fnSetData=function(a,b,c){return Q(g)(a,b,c)};"number"!==typeof g&&(a._rowReadObject=
!0);a.oFeatures.bSort||(b.bSortable=!1,d.addClass(e.sSortableNone));a=-1!==h.inArray("asc",b.asSorting);c=-1!==h.inArray("desc",b.asSorting);!b.bSortable||!a&&!c?(b.sSortingClass=e.sSortableNone,b.sSortingClassJUI=""):a&&!c?(b.sSortingClass=e.sSortableAsc,b.sSortingClassJUI=e.sSortJUIAscAllowed):!a&&c?(b.sSortingClass=e.sSortableDesc,b.sSortingClassJUI=e.sSortJUIDescAllowed):(b.sSortingClass=e.sSortable,b.sSortingClassJUI=e.sSortJUI)}function X(a){if(!1!==a.oFeatures.bAutoWidth){var b=a.aoColumns;
Ga(a);for(var c=0,e=b.length;c<e;c++)b[c].nTh.style.width=b[c].sWidth}b=a.oScroll;(""!==b.sY||""!==b.sX)&&Y(a);w(a,null,"column-sizing",[a])}function la(a,b){var c=Z(a,"bVisible");return"number"===typeof c[b]?c[b]:null}function $(a,b){var c=Z(a,"bVisible"),c=h.inArray(b,c);return-1!==c?c:null}function aa(a){return Z(a,"bVisible").length}function Z(a,b){var c=[];h.map(a.aoColumns,function(a,d){a[b]&&c.push(d)});return c}function Ha(a){var b=a.aoColumns,c=a.aoData,e=o.ext.type.detect,d,f,g,j,i,h,l,
p,n;d=0;for(f=b.length;d<f;d++)if(l=b[d],n=[],!l.sType&&l._sManualType)l.sType=l._sManualType;else if(!l.sType){g=0;for(j=e.length;g<j;g++){i=0;for(h=c.length;i<h;i++){n[i]===k&&(n[i]=y(a,i,d,"type"));p=e[g](n[i],a);if(!p&&g!==e.length-1)break;if("html"===p)break}if(p){l.sType=p;break}}l.sType||(l.sType="string")}}function ib(a,b,c,e){var d,f,g,j,i,m,l=a.aoColumns;if(b)for(d=b.length-1;0<=d;d--){m=b[d];var p=m.targets!==k?m.targets:m.aTargets;h.isArray(p)||(p=[p]);f=0;for(g=p.length;f<g;f++)if("number"===
typeof p[f]&&0<=p[f]){for(;l.length<=p[f];)Fa(a);e(p[f],m)}else if("number"===typeof p[f]&&0>p[f])e(l.length+p[f],m);else if("string"===typeof p[f]){j=0;for(i=l.length;j<i;j++)("_all"==p[f]||h(l[j].nTh).hasClass(p[f]))&&e(j,m)}}if(c){d=0;for(a=c.length;d<a;d++)e(d,c[d])}}function J(a,b,c,e){var d=a.aoData.length,f=h.extend(!0,{},o.models.oRow,{src:c?"dom":"data"});f._aData=b;a.aoData.push(f);for(var b=a.aoColumns,f=0,g=b.length;f<g;f++)c&&Ia(a,d,f,y(a,d,f)),b[f].sType=null;a.aiDisplayMaster.push(d);
(c||!a.oFeatures.bDeferRender)&&Ja(a,d,c,e);return d}function ma(a,b){var c;b instanceof h||(b=h(b));return b.map(function(b,d){c=na(a,d);return J(a,c.data,d,c.cells)})}function y(a,b,c,e){var d=a.iDraw,f=a.aoColumns[c],g=a.aoData[b]._aData,j=f.sDefaultContent,c=f.fnGetData(g,e,{settings:a,row:b,col:c});if(c===k)return a.iDrawError!=d&&null===j&&(R(a,0,"Requested unknown parameter "+("function"==typeof f.mData?"{function}":"'"+f.mData+"'")+" for row "+b,4),a.iDrawError=d),j;if((c===g||null===c)&&
null!==j)c=j;else if("function"===typeof c)return c.call(g);return null===c&&"display"==e?"":c}function Ia(a,b,c,e){a.aoColumns[c].fnSetData(a.aoData[b]._aData,e,{settings:a,row:b,col:c})}function Ka(a){return h.map(a.match(/(\\.|[^\.])+/g),function(a){return a.replace(/\\./g,".")})}function W(a){if(h.isPlainObject(a)){var b={};h.each(a,function(a,c){c&&(b[a]=W(c))});return function(a,c,f,g){var j=b[c]||b._;return j!==k?j(a,c,f,g):a}}if(null===a)return function(a){return a};if("function"===typeof a)return function(b,
c,f,g){return a(b,c,f,g)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var c=function(a,b,f){var g,j;if(""!==f){j=Ka(f);for(var i=0,h=j.length;i<h;i++){f=j[i].match(ba);g=j[i].match(S);if(f){j[i]=j[i].replace(ba,"");""!==j[i]&&(a=a[j[i]]);g=[];j.splice(0,i+1);j=j.join(".");i=0;for(h=a.length;i<h;i++)g.push(c(a[i],b,j));a=f[0].substring(1,f[0].length-1);a=""===a?g:g.join(a);break}else if(g){j[i]=j[i].replace(S,"");a=a[j[i]]();continue}if(null===a||a[j[i]]===
k)return k;a=a[j[i]]}}return a};return function(b,d){return c(b,d,a)}}return function(b){return b[a]}}function Q(a){if(h.isPlainObject(a))return Q(a._);if(null===a)return function(){};if("function"===typeof a)return function(b,e,d){a(b,"set",e,d)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var b=function(a,e,d){var d=Ka(d),f;f=d[d.length-1];for(var g,j,i=0,h=d.length-1;i<h;i++){g=d[i].match(ba);j=d[i].match(S);if(g){d[i]=d[i].replace(ba,"");a[d[i]]=[];
f=d.slice();f.splice(0,i+1);g=f.join(".");j=0;for(h=e.length;j<h;j++)f={},b(f,e[j],g),a[d[i]].push(f);return}j&&(d[i]=d[i].replace(S,""),a=a[d[i]](e));if(null===a[d[i]]||a[d[i]]===k)a[d[i]]={};a=a[d[i]]}if(f.match(S))a[f.replace(S,"")](e);else a[f.replace(ba,"")]=e};return function(c,e){return b(c,e,a)}}return function(b,e){b[a]=e}}function La(a){return D(a.aoData,"_aData")}function oa(a){a.aoData.length=0;a.aiDisplayMaster.length=0;a.aiDisplay.length=0}function pa(a,b,c){for(var e=-1,d=0,f=a.length;d<
f;d++)a[d]==b?e=d:a[d]>b&&a[d]--; -1!=e&&c===k&&a.splice(e,1)}function ca(a,b,c,e){var d=a.aoData[b],f,g=function(c,f){for(;c.childNodes.length;)c.removeChild(c.firstChild);c.innerHTML=y(a,b,f,"display")};if("dom"===c||(!c||"auto"===c)&&"dom"===d.src)d._aData=na(a,d,e,e===k?k:d._aData).data;else{var j=d.anCells;if(j)if(e!==k)g(j[e],e);else{c=0;for(f=j.length;c<f;c++)g(j[c],c)}}d._aSortData=null;d._aFilterData=null;g=a.aoColumns;if(e!==k)g[e].sType=null;else{c=0;for(f=g.length;c<f;c++)g[c].sType=null;
Ma(d)}}function na(a,b,c,e){var d=[],f=b.firstChild,g,j=0,i,m=a.aoColumns,l=a._rowReadObject,e=e||l?{}:[],p=function(a,b){if("string"===typeof a){var c=a.indexOf("@");-1!==c&&(c=a.substring(c+1),Q(a)(e,b.getAttribute(c)))}},a=function(a){if(c===k||c===j)g=m[j],i=h.trim(a.innerHTML),g&&g._bAttrSrc?(Q(g.mData._)(e,i),p(g.mData.sort,a),p(g.mData.type,a),p(g.mData.filter,a)):l?(g._setter||(g._setter=Q(g.mData)),g._setter(e,i)):e[j]=i;j++};if(f)for(;f;){b=f.nodeName.toUpperCase();if("TD"==b||"TH"==b)a(f),
d.push(f);f=f.nextSibling}else{d=b.anCells;f=0;for(b=d.length;f<b;f++)a(d[f])}return{data:e,cells:d}}function Ja(a,b,c,e){var d=a.aoData[b],f=d._aData,g=[],j,i,h,l,p;if(null===d.nTr){j=c||P.createElement("tr");d.nTr=j;d.anCells=g;j._DT_RowIndex=b;Ma(d);l=0;for(p=a.aoColumns.length;l<p;l++){h=a.aoColumns[l];i=c?e[l]:P.createElement(h.sCellType);g.push(i);if(!c||h.mRender||h.mData!==l)i.innerHTML=y(a,b,l,"display");h.sClass&&(i.className+=" "+h.sClass);h.bVisible&&!c?j.appendChild(i):!h.bVisible&&c&&
i.parentNode.removeChild(i);h.fnCreatedCell&&h.fnCreatedCell.call(a.oInstance,i,y(a,b,l),f,b,l)}w(a,"aoRowCreatedCallback",null,[j,f,b])}d.nTr.setAttribute("role","row")}function Ma(a){var b=a.nTr,c=a._aData;if(b){c.DT_RowId&&(b.id=c.DT_RowId);if(c.DT_RowClass){var e=c.DT_RowClass.split(" ");a.__rowc=a.__rowc?Na(a.__rowc.concat(e)):e;h(b).removeClass(a.__rowc.join(" ")).addClass(c.DT_RowClass)}c.DT_RowAttr&&h(b).attr(c.DT_RowAttr);c.DT_RowData&&h(b).data(c.DT_RowData)}}function jb(a){var b,c,e,d,
f,g=a.nTHead,j=a.nTFoot,i=0===h("th, td",g).length,m=a.oClasses,l=a.aoColumns;i&&(d=h("<tr/>").appendTo(g));b=0;for(c=l.length;b<c;b++)f=l[b],e=h(f.nTh).addClass(f.sClass),i&&e.appendTo(d),a.oFeatures.bSort&&(e.addClass(f.sSortingClass),!1!==f.bSortable&&(e.attr("tabindex",a.iTabIndex).attr("aria-controls",a.sTableId),Oa(a,f.nTh,b))),f.sTitle!=e.html()&&e.html(f.sTitle),Pa(a,"header")(a,e,f,m);i&&da(a.aoHeader,g);h(g).find(">tr").attr("role","row");h(g).find(">tr>th, >tr>td").addClass(m.sHeaderTH);
h(j).find(">tr>th, >tr>td").addClass(m.sFooterTH);if(null!==j){a=a.aoFooter[0];b=0;for(c=a.length;b<c;b++)f=l[b],f.nTf=a[b].cell,f.sClass&&h(f.nTf).addClass(f.sClass)}}function ea(a,b,c){var e,d,f,g=[],j=[],i=a.aoColumns.length,m;if(b){c===k&&(c=!1);e=0;for(d=b.length;e<d;e++){g[e]=b[e].slice();g[e].nTr=b[e].nTr;for(f=i-1;0<=f;f--)!a.aoColumns[f].bVisible&&!c&&g[e].splice(f,1);j.push([])}e=0;for(d=g.length;e<d;e++){if(a=g[e].nTr)for(;f=a.firstChild;)a.removeChild(f);f=0;for(b=g[e].length;f<b;f++)if(m=
i=1,j[e][f]===k){a.appendChild(g[e][f].cell);for(j[e][f]=1;g[e+i]!==k&&g[e][f].cell==g[e+i][f].cell;)j[e+i][f]=1,i++;for(;g[e][f+m]!==k&&g[e][f].cell==g[e][f+m].cell;){for(c=0;c<i;c++)j[e+c][f+m]=1;m++}h(g[e][f].cell).attr("rowspan",i).attr("colspan",m)}}}}function M(a){var b=w(a,"aoPreDrawCallback","preDraw",[a]);if(-1!==h.inArray(!1,b))C(a,!1);else{var b=[],c=0,e=a.asStripeClasses,d=e.length,f=a.oLanguage,g=a.iInitDisplayStart,j="ssp"==B(a),i=a.aiDisplay;a.bDrawing=!0;g!==k&&-1!==g&&(a._iDisplayStart=
j?g:g>=a.fnRecordsDisplay()?0:g,a.iInitDisplayStart=-1);var g=a._iDisplayStart,m=a.fnDisplayEnd();if(a.bDeferLoading)a.bDeferLoading=!1,a.iDraw++,C(a,!1);else if(j){if(!a.bDestroying&&!kb(a))return}else a.iDraw++;if(0!==i.length){f=j?a.aoData.length:m;for(j=j?0:g;j<f;j++){var l=i[j],p=a.aoData[l];null===p.nTr&&Ja(a,l);l=p.nTr;if(0!==d){var n=e[c%d];p._sRowStripe!=n&&(h(l).removeClass(p._sRowStripe).addClass(n),p._sRowStripe=n)}w(a,"aoRowCallback",null,[l,p._aData,c,j]);b.push(l);c++}}else c=f.sZeroRecords,
1==a.iDraw&&"ajax"==B(a)?c=f.sLoadingRecords:f.sEmptyTable&&0===a.fnRecordsTotal()&&(c=f.sEmptyTable),b[0]=h("<tr/>",{"class":d?e[0]:""}).append(h("<td />",{valign:"top",colSpan:aa(a),"class":a.oClasses.sRowEmpty}).html(c))[0];w(a,"aoHeaderCallback","header",[h(a.nTHead).children("tr")[0],La(a),g,m,i]);w(a,"aoFooterCallback","footer",[h(a.nTFoot).children("tr")[0],La(a),g,m,i]);e=h(a.nTBody);e.children().detach();e.append(h(b));w(a,"aoDrawCallback","draw",[a]);a.bSorted=!1;a.bFiltered=!1;a.bDrawing=
!1}}function N(a,b){var c=a.oFeatures,e=c.bFilter;c.bSort&&lb(a);e?fa(a,a.oPreviousSearch):a.aiDisplay=a.aiDisplayMaster.slice();!0!==b&&(a._iDisplayStart=0);a._drawHold=b;M(a);a._drawHold=!1}function mb(a){var b=a.oClasses,c=h(a.nTable),c=h("<div/>").insertBefore(c),e=a.oFeatures,d=h("<div/>",{id:a.sTableId+"_wrapper","class":b.sWrapper+(a.nTFoot?"":" "+b.sNoFooter)});a.nHolding=c[0];a.nTableWrapper=d[0];a.nTableReinsertBefore=a.nTable.nextSibling;for(var f=a.sDom.split(""),g,j,i,m,l,p,n=0;n<f.length;n++){g=
null;j=f[n];if("<"==j){i=h("<div/>")[0];m=f[n+1];if("'"==m||'"'==m){l="";for(p=2;f[n+p]!=m;)l+=f[n+p],p++;"H"==l?l=b.sJUIHeader:"F"==l&&(l=b.sJUIFooter);-1!=l.indexOf(".")?(m=l.split("."),i.id=m[0].substr(1,m[0].length-1),i.className=m[1]):"#"==l.charAt(0)?i.id=l.substr(1,l.length-1):i.className=l;n+=p}d.append(i);d=h(i)}else if(">"==j)d=d.parent();else if("l"==j&&e.bPaginate&&e.bLengthChange)g=nb(a);else if("f"==j&&e.bFilter)g=ob(a);else if("r"==j&&e.bProcessing)g=pb(a);else if("t"==j)g=qb(a);else if("i"==
j&&e.bInfo)g=rb(a);else if("p"==j&&e.bPaginate)g=sb(a);else if(0!==o.ext.feature.length){i=o.ext.feature;p=0;for(m=i.length;p<m;p++)if(j==i[p].cFeature){g=i[p].fnInit(a);break}}g&&(i=a.aanFeatures,i[j]||(i[j]=[]),i[j].push(g),d.append(g))}c.replaceWith(d)}function da(a,b){var c=h(b).children("tr"),e,d,f,g,j,i,m,l,p,n;a.splice(0,a.length);f=0;for(i=c.length;f<i;f++)a.push([]);f=0;for(i=c.length;f<i;f++){e=c[f];for(d=e.firstChild;d;){if("TD"==d.nodeName.toUpperCase()||"TH"==d.nodeName.toUpperCase()){l=
1*d.getAttribute("colspan");p=1*d.getAttribute("rowspan");l=!l||0===l||1===l?1:l;p=!p||0===p||1===p?1:p;g=0;for(j=a[f];j[g];)g++;m=g;n=1===l?!0:!1;for(j=0;j<l;j++)for(g=0;g<p;g++)a[f+g][m+j]={cell:d,unique:n},a[f+g].nTr=e}d=d.nextSibling}}}function qa(a,b,c){var e=[];c||(c=a.aoHeader,b&&(c=[],da(c,b)));for(var b=0,d=c.length;b<d;b++)for(var f=0,g=c[b].length;f<g;f++)if(c[b][f].unique&&(!e[f]||!a.bSortCellsTop))e[f]=c[b][f].cell;return e}function ra(a,b,c){w(a,"aoServerParams","serverParams",[b]);
if(b&&h.isArray(b)){var e={},d=/(.*?)\[\]$/;h.each(b,function(a,b){var c=b.name.match(d);c?(c=c[0],e[c]||(e[c]=[]),e[c].push(b.value)):e[b.name]=b.value});b=e}var f,g=a.ajax,j=a.oInstance;if(h.isPlainObject(g)&&g.data){f=g.data;var i=h.isFunction(f)?f(b):f,b=h.isFunction(f)&&i?i:h.extend(!0,b,i);delete g.data}i={data:b,success:function(b){var f=b.error||b.sError;f&&a.oApi._fnLog(a,0,f);a.json=b;w(a,null,"xhr",[a,b]);c(b)},dataType:"json",cache:!1,type:a.sServerMethod,error:function(b,c){var f=a.oApi._fnLog;
"parsererror"==c?f(a,0,"Invalid JSON response",1):4===b.readyState&&f(a,0,"Ajax error",7);C(a,!1)}};a.oAjaxData=b;w(a,null,"preXhr",[a,b]);a.fnServerData?a.fnServerData.call(j,a.sAjaxSource,h.map(b,function(a,b){return{name:b,value:a}}),c,a):a.sAjaxSource||"string"===typeof g?a.jqXHR=h.ajax(h.extend(i,{url:g||a.sAjaxSource})):h.isFunction(g)?a.jqXHR=g.call(j,b,c,a):(a.jqXHR=h.ajax(h.extend(i,g)),g.data=f)}function kb(a){return a.bAjaxDataGet?(a.iDraw++,C(a,!0),ra(a,tb(a),function(b){ub(a,b)}),!1):
!0}function tb(a){var b=a.aoColumns,c=b.length,e=a.oFeatures,d=a.oPreviousSearch,f=a.aoPreSearchCols,g,j=[],i,m,l,p=T(a);g=a._iDisplayStart;i=!1!==e.bPaginate?a._iDisplayLength:-1;var n=function(a,b){j.push({name:a,value:b})};n("sEcho",a.iDraw);n("iColumns",c);n("sColumns",D(b,"sName").join(","));n("iDisplayStart",g);n("iDisplayLength",i);var k={draw:a.iDraw,columns:[],order:[],start:g,length:i,search:{value:d.sSearch,regex:d.bRegex}};for(g=0;g<c;g++)m=b[g],l=f[g],i="function"==typeof m.mData?"function":
m.mData,k.columns.push({data:i,name:m.sName,searchable:m.bSearchable,orderable:m.bSortable,search:{value:l.sSearch,regex:l.bRegex}}),n("mDataProp_"+g,i),e.bFilter&&(n("sSearch_"+g,l.sSearch),n("bRegex_"+g,l.bRegex),n("bSearchable_"+g,m.bSearchable)),e.bSort&&n("bSortable_"+g,m.bSortable);e.bFilter&&(n("sSearch",d.sSearch),n("bRegex",d.bRegex));e.bSort&&(h.each(p,function(a,b){k.order.push({column:b.col,dir:b.dir});n("iSortCol_"+a,b.col);n("sSortDir_"+a,b.dir)}),n("iSortingCols",p.length));b=o.ext.legacy.ajax;
return null===b?a.sAjaxSource?j:k:b?j:k}function ub(a,b){var c=b.sEcho!==k?b.sEcho:b.draw,e=b.iTotalRecords!==k?b.iTotalRecords:b.recordsTotal,d=b.iTotalDisplayRecords!==k?b.iTotalDisplayRecords:b.recordsFiltered;if(c){if(1*c<a.iDraw)return;a.iDraw=1*c}oa(a);a._iRecordsTotal=parseInt(e,10);a._iRecordsDisplay=parseInt(d,10);c=sa(a,b);e=0;for(d=c.length;e<d;e++)J(a,c[e]);a.aiDisplay=a.aiDisplayMaster.slice();a.bAjaxDataGet=!1;M(a);a._bInitComplete||ta(a,b);a.bAjaxDataGet=!0;C(a,!1)}function sa(a,b){var c=
h.isPlainObject(a.ajax)&&a.ajax.dataSrc!==k?a.ajax.dataSrc:a.sAjaxDataProp;return"data"===c?b.aaData||b[c]:""!==c?W(c)(b):b}function ob(a){var b=a.oClasses,c=a.sTableId,e=a.oLanguage,d=a.oPreviousSearch,f=a.aanFeatures,g='<input type="search" class="'+b.sFilterInput+'"/>',j=e.sSearch,j=j.match(/_INPUT_/)?j.replace("_INPUT_",g):j+g,b=h("<div/>",{id:!f.f?c+"_filter":null,"class":b.sFilter}).append(h("<label/>").append(j)),f=function(){var b=!this.value?"":this.value;b!=d.sSearch&&(fa(a,{sSearch:b,bRegex:d.bRegex,
bSmart:d.bSmart,bCaseInsensitive:d.bCaseInsensitive}),a._iDisplayStart=0,M(a))},g=null!==a.searchDelay?a.searchDelay:"ssp"===B(a)?400:0,i=h("input",b).val(d.sSearch).attr("placeholder",e.sSearchPlaceholder).bind("keyup.DT search.DT input.DT paste.DT cut.DT",g?ua(f,g):f).bind("keypress.DT",function(a){if(13==a.keyCode)return!1}).attr("aria-controls",c);h(a.nTable).on("search.dt.DT",function(b,c){if(a===c)try{i[0]!==P.activeElement&&i.val(d.sSearch)}catch(f){}});return b[0]}function fa(a,b,c){var e=
a.oPreviousSearch,d=a.aoPreSearchCols,f=function(a){e.sSearch=a.sSearch;e.bRegex=a.bRegex;e.bSmart=a.bSmart;e.bCaseInsensitive=a.bCaseInsensitive};Ha(a);if("ssp"!=B(a)){vb(a,b.sSearch,c,b.bEscapeRegex!==k?!b.bEscapeRegex:b.bRegex,b.bSmart,b.bCaseInsensitive);f(b);for(b=0;b<d.length;b++)wb(a,d[b].sSearch,b,d[b].bEscapeRegex!==k?!d[b].bEscapeRegex:d[b].bRegex,d[b].bSmart,d[b].bCaseInsensitive);xb(a)}else f(b);a.bFiltered=!0;w(a,null,"search",[a])}function xb(a){for(var b=o.ext.search,c=a.aiDisplay,
e,d,f=0,g=b.length;f<g;f++){for(var j=[],i=0,h=c.length;i<h;i++)d=c[i],e=a.aoData[d],b[f](a,e._aFilterData,d,e._aData,i)&&j.push(d);c.length=0;c.push.apply(c,j)}}function wb(a,b,c,e,d,f){if(""!==b)for(var g=a.aiDisplay,e=Qa(b,e,d,f),d=g.length-1;0<=d;d--)b=a.aoData[g[d]]._aFilterData[c],e.test(b)||g.splice(d,1)}function vb(a,b,c,e,d,f){var e=Qa(b,e,d,f),d=a.oPreviousSearch.sSearch,f=a.aiDisplayMaster,g;0!==o.ext.search.length&&(c=!0);g=yb(a);if(0>=b.length)a.aiDisplay=f.slice();else{if(g||c||d.length>
b.length||0!==b.indexOf(d)||a.bSorted)a.aiDisplay=f.slice();b=a.aiDisplay;for(c=b.length-1;0<=c;c--)e.test(a.aoData[b[c]]._sFilterRow)||b.splice(c,1)}}function Qa(a,b,c,e){a=b?a:va(a);c&&(a="^(?=.*?"+h.map(a.match(/"[^"]+"|[^ ]+/g)||"",function(a){if('"'===a.charAt(0))var b=a.match(/^"(.*)"$/),a=b?b[1]:a;return a.replace('"',"")}).join(")(?=.*?")+").*$");return RegExp(a,e?"i":"")}function va(a){return a.replace(Yb,"\\$1")}function yb(a){var b=a.aoColumns,c,e,d,f,g,j,i,h,l=o.ext.type.search;c=!1;e=
0;for(f=a.aoData.length;e<f;e++)if(h=a.aoData[e],!h._aFilterData){j=[];d=0;for(g=b.length;d<g;d++)c=b[d],c.bSearchable?(i=y(a,e,d,"filter"),l[c.sType]&&(i=l[c.sType](i)),null===i&&(i=""),"string"!==typeof i&&i.toString&&(i=i.toString())):i="",i.indexOf&&-1!==i.indexOf("&")&&(wa.innerHTML=i,i=Zb?wa.textContent:wa.innerText),i.replace&&(i=i.replace(/[\r\n]/g,"")),j.push(i);h._aFilterData=j;h._sFilterRow=j.join("  ");c=!0}return c}function zb(a){return{search:a.sSearch,smart:a.bSmart,regex:a.bRegex,
caseInsensitive:a.bCaseInsensitive}}function Ab(a){return{sSearch:a.search,bSmart:a.smart,bRegex:a.regex,bCaseInsensitive:a.caseInsensitive}}function rb(a){var b=a.sTableId,c=a.aanFeatures.i,e=h("<div/>",{"class":a.oClasses.sInfo,id:!c?b+"_info":null});c||(a.aoDrawCallback.push({fn:Bb,sName:"information"}),e.attr("role","status").attr("aria-live","polite"),h(a.nTable).attr("aria-describedby",b+"_info"));return e[0]}function Bb(a){var b=a.aanFeatures.i;if(0!==b.length){var c=a.oLanguage,e=a._iDisplayStart+
1,d=a.fnDisplayEnd(),f=a.fnRecordsTotal(),g=a.fnRecordsDisplay(),j=g?c.sInfo:c.sInfoEmpty;g!==f&&(j+=" "+c.sInfoFiltered);j+=c.sInfoPostFix;j=Cb(a,j);c=c.fnInfoCallback;null!==c&&(j=c.call(a.oInstance,a,e,d,f,g,j));h(b).html(j)}}function Cb(a,b){var c=a.fnFormatNumber,e=a._iDisplayStart+1,d=a._iDisplayLength,f=a.fnRecordsDisplay(),g=-1===d;return b.replace(/_START_/g,c.call(a,e)).replace(/_END_/g,c.call(a,a.fnDisplayEnd())).replace(/_MAX_/g,c.call(a,a.fnRecordsTotal())).replace(/_TOTAL_/g,c.call(a,
f)).replace(/_PAGE_/g,c.call(a,g?1:Math.ceil(e/d))).replace(/_PAGES_/g,c.call(a,g?1:Math.ceil(f/d)))}function ga(a){var b,c,e=a.iInitDisplayStart,d=a.aoColumns,f;c=a.oFeatures;if(a.bInitialised){mb(a);jb(a);ea(a,a.aoHeader);ea(a,a.aoFooter);C(a,!0);c.bAutoWidth&&Ga(a);b=0;for(c=d.length;b<c;b++)f=d[b],f.sWidth&&(f.nTh.style.width=s(f.sWidth));N(a);d=B(a);"ssp"!=d&&("ajax"==d?ra(a,[],function(c){var f=sa(a,c);for(b=0;b<f.length;b++)J(a,f[b]);a.iInitDisplayStart=e;N(a);C(a,!1);ta(a,c)},a):(C(a,!1),
ta(a)))}else setTimeout(function(){ga(a)},200)}function ta(a,b){a._bInitComplete=!0;b&&X(a);w(a,"aoInitComplete","init",[a,b])}function Ra(a,b){var c=parseInt(b,10);a._iDisplayLength=c;Sa(a);w(a,null,"length",[a,c])}function nb(a){for(var b=a.oClasses,c=a.sTableId,e=a.aLengthMenu,d=h.isArray(e[0]),f=d?e[0]:e,e=d?e[1]:e,d=h("<select/>",{name:c+"_length","aria-controls":c,"class":b.sLengthSelect}),g=0,j=f.length;g<j;g++)d[0][g]=new Option(e[g],f[g]);var i=h("<div><label/></div>").addClass(b.sLength);
a.aanFeatures.l||(i[0].id=c+"_length");i.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",d[0].outerHTML));h("select",i).val(a._iDisplayLength).bind("change.DT",function(){Ra(a,h(this).val());M(a)});h(a.nTable).bind("length.dt.DT",function(b,c,f){a===c&&h("select",i).val(f)});return i[0]}function sb(a){var b=a.sPaginationType,c=o.ext.pager[b],e="function"===typeof c,d=function(a){M(a)},b=h("<div/>").addClass(a.oClasses.sPaging+b)[0],f=a.aanFeatures;e||c.fnInit(a,b,d);f.p||(b.id=a.sTableId+
"_paginate",a.aoDrawCallback.push({fn:function(a){if(e){var b=a._iDisplayStart,h=a._iDisplayLength,m=a.fnRecordsDisplay(),l=-1===h,b=l?0:Math.ceil(b/h),h=l?1:Math.ceil(m/h),m=c(b,h),p,l=0;for(p=f.p.length;l<p;l++)Pa(a,"pageButton")(a,f.p[l],l,m,b,h)}else c.fnUpdate(a,d)},sName:"pagination"}));return b}function Ta(a,b,c){var e=a._iDisplayStart,d=a._iDisplayLength,f=a.fnRecordsDisplay();0===f||-1===d?e=0:"number"===typeof b?(e=b*d,e>f&&(e=0)):"first"==b?e=0:"previous"==b?(e=0<=d?e-d:0,0>e&&(e=0)):"next"==
b?e+d<f&&(e+=d):"last"==b?e=Math.floor((f-1)/d)*d:R(a,0,"Unknown paging action: "+b,5);b=a._iDisplayStart!==e;a._iDisplayStart=e;b&&(w(a,null,"page",[a]),c&&M(a));return b}function pb(a){return h("<div/>",{id:!a.aanFeatures.r?a.sTableId+"_processing":null,"class":a.oClasses.sProcessing}).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]}function C(a,b){a.oFeatures.bProcessing&&h(a.aanFeatures.r).css("display",b?"block":"none");w(a,null,"processing",[a,b])}function qb(a){var b=h(a.nTable);b.attr("role",
"grid");var c=a.oScroll;if(""===c.sX&&""===c.sY)return a.nTable;var e=c.sX,d=c.sY,f=a.oClasses,g=b.children("caption"),j=g.length?g[0]._captionSide:null,i=h(b[0].cloneNode(!1)),m=h(b[0].cloneNode(!1)),l=b.children("tfoot");c.sX&&"100%"===b.attr("width")&&b.removeAttr("width");l.length||(l=null);c=h("<div/>",{"class":f.sScrollWrapper}).append(h("<div/>",{"class":f.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,width:e?!e?null:s(e):"100%"}).append(h("<div/>",{"class":f.sScrollHeadInner}).css({"box-sizing":"content-box",
width:c.sXInner||"100%"}).append(i.removeAttr("id").css("margin-left",0).append("top"===j?g:null).append(b.children("thead"))))).append(h("<div/>",{"class":f.sScrollBody}).css({overflow:"auto",height:!d?null:s(d),width:!e?null:s(e)}).append(b));l&&c.append(h("<div/>",{"class":f.sScrollFoot}).css({overflow:"hidden",border:0,width:e?!e?null:s(e):"100%"}).append(h("<div/>",{"class":f.sScrollFootInner}).append(m.removeAttr("id").css("margin-left",0).append("bottom"===j?g:null).append(b.children("tfoot")))));
var b=c.children(),p=b[0],f=b[1],n=l?b[2]:null;if(e)h(f).on("scroll.DT",function(){var a=this.scrollLeft;p.scrollLeft=a;l&&(n.scrollLeft=a)});a.nScrollHead=p;a.nScrollBody=f;a.nScrollFoot=n;a.aoDrawCallback.push({fn:Y,sName:"scrolling"});return c[0]}function Y(a){var b=a.oScroll,c=b.sX,e=b.sXInner,d=b.sY,f=b.iBarWidth,g=h(a.nScrollHead),j=g[0].style,i=g.children("div"),m=i[0].style,l=i.children("table"),i=a.nScrollBody,p=h(i),n=i.style,k=h(a.nScrollFoot).children("div"),q=k.children("table"),o=h(a.nTHead),
r=h(a.nTable),t=r[0],u=t.style,K=a.nTFoot?h(a.nTFoot):null,ha=a.oBrowser,w=ha.bScrollOversize,x,v,y,L,z,A=[],B=[],C=[],D,E=function(a){a=a.style;a.paddingTop="0";a.paddingBottom="0";a.borderTopWidth="0";a.borderBottomWidth="0";a.height=0};r.children("thead, tfoot").remove();z=o.clone().prependTo(r);x=o.find("tr");y=z.find("tr");z.find("th, td").removeAttr("tabindex");K&&(L=K.clone().prependTo(r),v=K.find("tr"),L=L.find("tr"));c||(n.width="100%",g[0].style.width="100%");h.each(qa(a,z),function(b,c){D=
la(a,b);c.style.width=a.aoColumns[D].sWidth});K&&G(function(a){a.style.width=""},L);b.bCollapse&&""!==d&&(n.height=p[0].offsetHeight+o[0].offsetHeight+"px");g=r.outerWidth();if(""===c){if(u.width="100%",w&&(r.find("tbody").height()>i.offsetHeight||"scroll"==p.css("overflow-y")))u.width=s(r.outerWidth()-f)}else""!==e?u.width=s(e):g==p.width()&&p.height()<r.height()?(u.width=s(g-f),r.outerWidth()>g-f&&(u.width=s(g))):u.width=s(g);g=r.outerWidth();G(E,y);G(function(a){C.push(a.innerHTML);A.push(s(h(a).css("width")))},
y);G(function(a,b){a.style.width=A[b]},x);h(y).height(0);K&&(G(E,L),G(function(a){B.push(s(h(a).css("width")))},L),G(function(a,b){a.style.width=B[b]},v),h(L).height(0));G(function(a,b){a.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+C[b]+"</div>";a.style.width=A[b]},y);K&&G(function(a,b){a.innerHTML="";a.style.width=B[b]},L);if(r.outerWidth()<g){v=i.scrollHeight>i.offsetHeight||"scroll"==p.css("overflow-y")?g+f:g;if(w&&(i.scrollHeight>i.offsetHeight||"scroll"==p.css("overflow-y")))u.width=
s(v-f);(""===c||""!==e)&&R(a,1,"Possible column misalignment",6)}else v="100%";n.width=s(v);j.width=s(v);K&&(a.nScrollFoot.style.width=s(v));!d&&w&&(n.height=s(t.offsetHeight+f));d&&b.bCollapse&&(n.height=s(d),b=c&&t.offsetWidth>i.offsetWidth?f:0,t.offsetHeight<i.offsetHeight&&(n.height=s(t.offsetHeight+b)));b=r.outerWidth();l[0].style.width=s(b);m.width=s(b);l=r.height()>i.clientHeight||"scroll"==p.css("overflow-y");ha="padding"+(ha.bScrollbarLeft?"Left":"Right");m[ha]=l?f+"px":"0px";K&&(q[0].style.width=
s(b),k[0].style.width=s(b),k[0].style[ha]=l?f+"px":"0px");p.scroll();if((a.bSorted||a.bFiltered)&&!a._drawHold)i.scrollTop=0}function G(a,b,c){for(var e=0,d=0,f=b.length,g,j;d<f;){g=b[d].firstChild;for(j=c?c[d].firstChild:null;g;)1===g.nodeType&&(c?a(g,j,e):a(g,e),e++),g=g.nextSibling,j=c?j.nextSibling:null;d++}}function Ga(a){var b=a.nTable,c=a.aoColumns,e=a.oScroll,d=e.sY,f=e.sX,g=e.sXInner,j=c.length,e=Z(a,"bVisible"),i=h("th",a.nTHead),m=b.style.width||b.getAttribute("width"),l=b.parentNode,p=
!1,n,k;for(n=0;n<e.length;n++)k=c[e[n]],null!==k.sWidth&&(k.sWidth=Db(k.sWidthOrig,l),p=!0);if(!p&&!f&&!d&&j==aa(a)&&j==i.length)for(n=0;n<j;n++)c[n].sWidth=s(i.eq(n).width());else{j=h(b).clone().empty().css("visibility","hidden").removeAttr("id").append(h(a.nTHead).clone(!1)).append(h(a.nTFoot).clone(!1)).append(h("<tbody><tr/></tbody>"));j.find("tfoot th, tfoot td").css("width","");var q=j.find("tbody tr"),i=qa(a,j.find("thead")[0]);for(n=0;n<e.length;n++)k=c[e[n]],i[n].style.width=null!==k.sWidthOrig&&
""!==k.sWidthOrig?s(k.sWidthOrig):"";if(a.aoData.length)for(n=0;n<e.length;n++)p=e[n],k=c[p],h(Eb(a,p)).clone(!1).append(k.sContentPadding).appendTo(q);j.appendTo(l);f&&g?j.width(g):f?(j.css("width","auto"),j.width()<l.offsetWidth&&j.width(l.offsetWidth)):d?j.width(l.offsetWidth):m&&j.width(m);Fb(a,j[0]);if(f){for(n=g=0;n<e.length;n++)k=c[e[n]],d=h(i[n]).outerWidth(),g+=null===k.sWidthOrig?d:parseInt(k.sWidth,10)+d-h(i[n]).width();j.width(s(g));b.style.width=s(g)}for(n=0;n<e.length;n++)if(k=c[e[n]],
d=h(i[n]).width())k.sWidth=s(d);b.style.width=s(j.css("width"));j.remove()}m&&(b.style.width=s(m));if((m||f)&&!a._reszEvt)h(Ea).bind("resize.DT-"+a.sInstance,ua(function(){X(a)})),a._reszEvt=!0}function ua(a,b){var c=b!==k?b:200,e,d;return function(){var b=this,g=+new Date,j=arguments;e&&g<e+c?(clearTimeout(d),d=setTimeout(function(){e=k;a.apply(b,j)},c)):(e=g,a.apply(b,j))}}function Db(a,b){if(!a)return 0;var c=h("<div/>").css("width",s(a)).appendTo(b||P.body),e=c[0].offsetWidth;c.remove();return e}
function Fb(a,b){var c=a.oScroll;if(c.sX||c.sY)c=!c.sX?c.iBarWidth:0,b.style.width=s(h(b).outerWidth()-c)}function Eb(a,b){var c=Gb(a,b);if(0>c)return null;var e=a.aoData[c];return!e.nTr?h("<td/>").html(y(a,c,b,"display"))[0]:e.anCells[b]}function Gb(a,b){for(var c,e=-1,d=-1,f=0,g=a.aoData.length;f<g;f++)c=y(a,f,b,"display")+"",c=c.replace($b,""),c.length>e&&(e=c.length,d=f);return d}function s(a){return null===a?"0px":"number"==typeof a?0>a?"0px":a+"px":a.match(/\d$/)?a+"px":a}function Hb(){if(!o.__scrollbarWidth){var a=
h("<p/>").css({width:"100%",height:200,padding:0})[0],b=h("<div/>").css({position:"absolute",top:0,left:0,width:200,height:150,padding:0,overflow:"hidden",visibility:"hidden"}).append(a).appendTo("body"),c=a.offsetWidth;b.css("overflow","scroll");a=a.offsetWidth;c===a&&(a=b[0].clientWidth);b.remove();o.__scrollbarWidth=c-a}return o.__scrollbarWidth}function T(a){var b,c,e=[],d=a.aoColumns,f,g,j,i;b=a.aaSortingFixed;c=h.isPlainObject(b);var m=[];f=function(a){a.length&&!h.isArray(a[0])?m.push(a):m.push.apply(m,
a)};h.isArray(b)&&f(b);c&&b.pre&&f(b.pre);f(a.aaSorting);c&&b.post&&f(b.post);for(a=0;a<m.length;a++){i=m[a][0];f=d[i].aDataSort;b=0;for(c=f.length;b<c;b++)g=f[b],j=d[g].sType||"string",m[a]._idx===k&&(m[a]._idx=h.inArray(m[a][1],d[g].asSorting)),e.push({src:i,col:g,dir:m[a][1],index:m[a]._idx,type:j,formatter:o.ext.type.order[j+"-pre"]})}return e}function lb(a){var b,c,e=[],d=o.ext.type.order,f=a.aoData,g=0,j,h=a.aiDisplayMaster,m;Ha(a);m=T(a);b=0;for(c=m.length;b<c;b++)j=m[b],j.formatter&&g++,Ib(a,
j.col);if("ssp"!=B(a)&&0!==m.length){b=0;for(c=h.length;b<c;b++)e[h[b]]=b;g===m.length?h.sort(function(a,b){var c,d,g,h,j=m.length,i=f[a]._aSortData,k=f[b]._aSortData;for(g=0;g<j;g++)if(h=m[g],c=i[h.col],d=k[h.col],c=c<d?-1:c>d?1:0,0!==c)return"asc"===h.dir?c:-c;c=e[a];d=e[b];return c<d?-1:c>d?1:0}):h.sort(function(a,b){var c,g,h,j,i=m.length,k=f[a]._aSortData,o=f[b]._aSortData;for(h=0;h<i;h++)if(j=m[h],c=k[j.col],g=o[j.col],j=d[j.type+"-"+j.dir]||d["string-"+j.dir],c=j(c,g),0!==c)return c;c=e[a];
g=e[b];return c<g?-1:c>g?1:0})}a.bSorted=!0}function Jb(a){for(var b,c,e=a.aoColumns,d=T(a),a=a.oLanguage.oAria,f=0,g=e.length;f<g;f++){c=e[f];var h=c.asSorting;b=c.sTitle.replace(/<.*?>/g,"");var i=c.nTh;i.removeAttribute("aria-sort");c.bSortable&&(0<d.length&&d[0].col==f?(i.setAttribute("aria-sort","asc"==d[0].dir?"ascending":"descending"),c=h[d[0].index+1]||h[0]):c=h[0],b+="asc"===c?a.sSortAscending:a.sSortDescending);i.setAttribute("aria-label",b)}}function Ua(a,b,c,e){var d=a.aaSorting,f=a.aoColumns[b].asSorting,
g=function(a,b){var c=a._idx;c===k&&(c=h.inArray(a[1],f));return c+1<f.length?c+1:b?null:0};"number"===typeof d[0]&&(d=a.aaSorting=[d]);c&&a.oFeatures.bSortMulti?(c=h.inArray(b,D(d,"0")),-1!==c?(b=g(d[c],!0),null===b?d.splice(c,1):(d[c][1]=f[b],d[c]._idx=b)):(d.push([b,f[0],0]),d[d.length-1]._idx=0)):d.length&&d[0][0]==b?(b=g(d[0]),d.length=1,d[0][1]=f[b],d[0]._idx=b):(d.length=0,d.push([b,f[0]]),d[0]._idx=0);N(a);"function"==typeof e&&e(a)}function Oa(a,b,c,e){var d=a.aoColumns[c];Va(b,{},function(b){!1!==
d.bSortable&&(a.oFeatures.bProcessing?(C(a,!0),setTimeout(function(){Ua(a,c,b.shiftKey,e);"ssp"!==B(a)&&C(a,!1)},0)):Ua(a,c,b.shiftKey,e))})}function xa(a){var b=a.aLastSort,c=a.oClasses.sSortColumn,e=T(a),d=a.oFeatures,f,g;if(d.bSort&&d.bSortClasses){d=0;for(f=b.length;d<f;d++)g=b[d].src,h(D(a.aoData,"anCells",g)).removeClass(c+(2>d?d+1:3));d=0;for(f=e.length;d<f;d++)g=e[d].src,h(D(a.aoData,"anCells",g)).addClass(c+(2>d?d+1:3))}a.aLastSort=e}function Ib(a,b){var c=a.aoColumns[b],e=o.ext.order[c.sSortDataType],
d;e&&(d=e.call(a.oInstance,a,b,$(a,b)));for(var f,g=o.ext.type.order[c.sType+"-pre"],h=0,i=a.aoData.length;h<i;h++)if(c=a.aoData[h],c._aSortData||(c._aSortData=[]),!c._aSortData[b]||e)f=e?d[h]:y(a,h,b,"sort"),c._aSortData[b]=g?g(f):f}function ya(a){if(a.oFeatures.bStateSave&&!a.bDestroying){var b={time:+new Date,start:a._iDisplayStart,length:a._iDisplayLength,order:h.extend(!0,[],a.aaSorting),search:zb(a.oPreviousSearch),columns:h.map(a.aoColumns,function(b,e){return{visible:b.bVisible,search:zb(a.aoPreSearchCols[e])}})};
w(a,"aoStateSaveParams","stateSaveParams",[a,b]);a.oSavedState=b;a.fnStateSaveCallback.call(a.oInstance,a,b)}}function Kb(a){var b,c,e=a.aoColumns;if(a.oFeatures.bStateSave){var d=a.fnStateLoadCallback.call(a.oInstance,a);if(d&&d.time&&(b=w(a,"aoStateLoadParams","stateLoadParams",[a,d]),-1===h.inArray(!1,b)&&(b=a.iStateDuration,!(0<b&&d.time<+new Date-1E3*b)&&e.length===d.columns.length))){a.oLoadedState=h.extend(!0,{},d);a._iDisplayStart=d.start;a.iInitDisplayStart=d.start;a._iDisplayLength=d.length;
a.aaSorting=[];h.each(d.order,function(b,c){a.aaSorting.push(c[0]>=e.length?[0,c[1]]:c)});h.extend(a.oPreviousSearch,Ab(d.search));b=0;for(c=d.columns.length;b<c;b++){var f=d.columns[b];e[b].bVisible=f.visible;h.extend(a.aoPreSearchCols[b],Ab(f.search))}w(a,"aoStateLoaded","stateLoaded",[a,d])}}}function za(a){var b=o.settings,a=h.inArray(a,D(b,"nTable"));return-1!==a?b[a]:null}function R(a,b,c,e){c="DataTables warning: "+(null!==a?"table id="+a.sTableId+" - ":"")+c;e&&(c+=". For more information about this error, please see http://datatables.net/tn/"+
e);if(b)Ea.console&&console.log&&console.log(c);else if(b=o.ext,b=b.sErrMode||b.errMode,w(a,null,"error",[a,e,c]),"alert"==b)alert(c);else{if("throw"==b)throw Error(c);"function"==typeof b&&b(a,e,c)}}function E(a,b,c,e){h.isArray(c)?h.each(c,function(c,f){h.isArray(f)?E(a,b,f[0],f[1]):E(a,b,f)}):(e===k&&(e=c),b[c]!==k&&(a[e]=b[c]))}function Lb(a,b,c){var e,d;for(d in b)b.hasOwnProperty(d)&&(e=b[d],h.isPlainObject(e)?(h.isPlainObject(a[d])||(a[d]={}),h.extend(!0,a[d],e)):a[d]=c&&"data"!==d&&"aaData"!==
d&&h.isArray(e)?e.slice():e);return a}function Va(a,b,c){h(a).bind("click.DT",b,function(b){a.blur();c(b)}).bind("keypress.DT",b,function(a){13===a.which&&(a.preventDefault(),c(a))}).bind("selectstart.DT",function(){return!1})}function z(a,b,c,e){c&&a[b].push({fn:c,sName:e})}function w(a,b,c,e){var d=[];b&&(d=h.map(a[b].slice().reverse(),function(b){return b.fn.apply(a.oInstance,e)}));null!==c&&h(a.nTable).trigger(c+".dt",e);return d}function Sa(a){var b=a._iDisplayStart,c=a.fnDisplayEnd(),e=a._iDisplayLength;
b>=c&&(b=c-e);b-=b%e;if(-1===e||0>b)b=0;a._iDisplayStart=b}function Pa(a,b){var c=a.renderer,e=o.ext.renderer[b];return h.isPlainObject(c)&&c[b]?e[c[b]]||e._:"string"===typeof c?e[c]||e._:e._}function B(a){return a.oFeatures.bServerSide?"ssp":a.ajax||a.sAjaxSource?"ajax":"dom"}function Wa(a,b){var c=[],c=Mb.numbers_length,e=Math.floor(c/2);b<=c?c=U(0,b):a<=e?(c=U(0,c-2),c.push("ellipsis"),c.push(b-1)):(a>=b-1-e?c=U(b-(c-2),b):(c=U(a-1,a+2),c.push("ellipsis"),c.push(b-1)),c.splice(0,0,"ellipsis"),
c.splice(0,0,0));c.DT_el="span";return c}function db(a){h.each({num:function(b){return Aa(b,a)},"num-fmt":function(b){return Aa(b,a,Xa)},"html-num":function(b){return Aa(b,a,Ba)},"html-num-fmt":function(b){return Aa(b,a,Ba,Xa)}},function(b,c){x.type.order[b+a+"-pre"]=c;b.match(/^html\-/)&&(x.type.search[b+a]=x.type.search.html)})}function Nb(a){return function(){var b=[za(this[o.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return o.ext.internal[a].apply(this,b)}}var o,x,t,r,u,Ya=
{},Ob=/[\r\n]/g,Ba=/<.*?>/g,ac=/^[\w\+\-]/,bc=/[\w\+\-]$/,Yb=RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)","g"),Xa=/[',$\u00a3\u20ac\u00a5%\u2009\u202F]/g,I=function(a){return!a||!0===a||"-"===a?!0:!1},Pb=function(a){var b=parseInt(a,10);return!isNaN(b)&&isFinite(a)?b:null},Qb=function(a,b){Ya[b]||(Ya[b]=RegExp(va(b),"g"));return"string"===typeof a&&"."!==b?a.replace(/\./g,"").replace(Ya[b],"."):a},Za=function(a,b,c){var e="string"===typeof a;b&&e&&(a=Qb(a,b));c&&e&&
(a=a.replace(Xa,""));return I(a)||!isNaN(parseFloat(a))&&isFinite(a)},Rb=function(a,b,c){return I(a)?!0:!(I(a)||"string"===typeof a)?null:Za(a.replace(Ba,""),b,c)?!0:null},D=function(a,b,c){var e=[],d=0,f=a.length;if(c!==k)for(;d<f;d++)a[d]&&a[d][b]&&e.push(a[d][b][c]);else for(;d<f;d++)a[d]&&e.push(a[d][b]);return e},ia=function(a,b,c,e){var d=[],f=0,g=b.length;if(e!==k)for(;f<g;f++)a[b[f]][c]&&d.push(a[b[f]][c][e]);else for(;f<g;f++)d.push(a[b[f]][c]);return d},U=function(a,b){var c=[],e;b===k?
(b=0,e=a):(e=b,b=a);for(var d=b;d<e;d++)c.push(d);return c},Sb=function(a){for(var b=[],c=0,e=a.length;c<e;c++)a[c]&&b.push(a[c]);return b},Na=function(a){var b=[],c,e,d=a.length,f,g=0;e=0;a:for(;e<d;e++){c=a[e];for(f=0;f<g;f++)if(b[f]===c)continue a;b.push(c);g++}return b},A=function(a,b,c){a[b]!==k&&(a[c]=a[b])},ba=/\[.*?\]$/,S=/\(\)$/,wa=h("<div>")[0],Zb=wa.textContent!==k,$b=/<.*?>/g;o=function(a){this.$=function(a,b){return this.api(!0).$(a,b)};this._=function(a,b){return this.api(!0).rows(a,
b).data()};this.api=function(a){return a?new t(za(this[x.iApiIndex])):new t(this)};this.fnAddData=function(a,b){var c=this.api(!0),e=h.isArray(a)&&(h.isArray(a[0])||h.isPlainObject(a[0]))?c.rows.add(a):c.row.add(a);(b===k||b)&&c.draw();return e.flatten().toArray()};this.fnAdjustColumnSizing=function(a){var b=this.api(!0).columns.adjust(),c=b.settings()[0],e=c.oScroll;a===k||a?b.draw(!1):(""!==e.sX||""!==e.sY)&&Y(c)};this.fnClearTable=function(a){var b=this.api(!0).clear();(a===k||a)&&b.draw()};this.fnClose=
function(a){this.api(!0).row(a).child.hide()};this.fnDeleteRow=function(a,b,c){var e=this.api(!0),a=e.rows(a),d=a.settings()[0],h=d.aoData[a[0][0]];a.remove();b&&b.call(this,d,h);(c===k||c)&&e.draw();return h};this.fnDestroy=function(a){this.api(!0).destroy(a)};this.fnDraw=function(a){this.api(!0).draw(!a)};this.fnFilter=function(a,b,c,e,d,h){d=this.api(!0);null===b||b===k?d.search(a,c,e,h):d.column(b).search(a,c,e,h);d.draw()};this.fnGetData=function(a,b){var c=this.api(!0);if(a!==k){var e=a.nodeName?
a.nodeName.toLowerCase():"";return b!==k||"td"==e||"th"==e?c.cell(a,b).data():c.row(a).data()||null}return c.data().toArray()};this.fnGetNodes=function(a){var b=this.api(!0);return a!==k?b.row(a).node():b.rows().nodes().flatten().toArray()};this.fnGetPosition=function(a){var b=this.api(!0),c=a.nodeName.toUpperCase();return"TR"==c?b.row(a).index():"TD"==c||"TH"==c?(a=b.cell(a).index(),[a.row,a.columnVisible,a.column]):null};this.fnIsOpen=function(a){return this.api(!0).row(a).child.isShown()};this.fnOpen=
function(a,b,c){return this.api(!0).row(a).child(b,c).show().child()[0]};this.fnPageChange=function(a,b){var c=this.api(!0).page(a);(b===k||b)&&c.draw(!1)};this.fnSetColumnVis=function(a,b,c){a=this.api(!0).column(a).visible(b);(c===k||c)&&a.columns.adjust().draw()};this.fnSettings=function(){return za(this[x.iApiIndex])};this.fnSort=function(a){this.api(!0).order(a).draw()};this.fnSortListener=function(a,b,c){this.api(!0).order.listener(a,b,c)};this.fnUpdate=function(a,b,c,e,d){var h=this.api(!0);
c===k||null===c?h.row(b).data(a):h.cell(b,c).data(a);(d===k||d)&&h.columns.adjust();(e===k||e)&&h.draw();return 0};this.fnVersionCheck=x.fnVersionCheck;var b=this,c=a===k,e=this.length;c&&(a={});this.oApi=this.internal=x.internal;for(var d in o.ext.internal)d&&(this[d]=Nb(d));this.each(function(){var d={},d=1<e?Lb(d,a,!0):a,g=0,j,i=this.getAttribute("id"),m=!1,l=o.defaults,p=h(this);if("table"!=this.nodeName.toLowerCase())R(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{eb(l);
fb(l.column);H(l,l,!0);H(l.column,l.column,!0);H(l,h.extend(d,p.data()));var n=o.settings,g=0;for(j=n.length;g<j;g++){var r=n[g];if(r.nTable==this||r.nTHead.parentNode==this||r.nTFoot&&r.nTFoot.parentNode==this){g=d.bRetrieve!==k?d.bRetrieve:l.bRetrieve;if(c||g)return r.oInstance;if(d.bDestroy!==k?d.bDestroy:l.bDestroy){r.oInstance.fnDestroy();break}else{R(r,0,"Cannot reinitialise DataTable",3);return}}if(r.sTableId==this.id){n.splice(g,1);break}}if(null===i||""===i)this.id=i="DataTables_Table_"+
o.ext._unique++;var q=h.extend(!0,{},o.models.oSettings,{nTable:this,oApi:b.internal,oInit:d,sDestroyWidth:p[0].style.width,sInstance:i,sTableId:i});n.push(q);q.oInstance=1===b.length?b:p.dataTable();eb(d);d.oLanguage&&O(d.oLanguage);d.aLengthMenu&&!d.iDisplayLength&&(d.iDisplayLength=h.isArray(d.aLengthMenu[0])?d.aLengthMenu[0][0]:d.aLengthMenu[0]);d=Lb(h.extend(!0,{},l),d);E(q.oFeatures,d,"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));
E(q,d,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"],["bJQueryUI","bJUI"]]);E(q.oScroll,d,[["sScrollX","sX"],["sScrollXInner",
"sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);E(q.oLanguage,d,"fnInfoCallback");z(q,"aoDrawCallback",d.fnDrawCallback,"user");z(q,"aoServerParams",d.fnServerParams,"user");z(q,"aoStateSaveParams",d.fnStateSaveParams,"user");z(q,"aoStateLoadParams",d.fnStateLoadParams,"user");z(q,"aoStateLoaded",d.fnStateLoaded,"user");z(q,"aoRowCallback",d.fnRowCallback,"user");z(q,"aoRowCreatedCallback",d.fnCreatedRow,"user");z(q,"aoHeaderCallback",d.fnHeaderCallback,"user");z(q,"aoFooterCallback",
d.fnFooterCallback,"user");z(q,"aoInitComplete",d.fnInitComplete,"user");z(q,"aoPreDrawCallback",d.fnPreDrawCallback,"user");i=q.oClasses;d.bJQueryUI?(h.extend(i,o.ext.oJUIClasses,d.oClasses),d.sDom===l.sDom&&"lfrtip"===l.sDom&&(q.sDom='<"H"lfr>t<"F"ip>'),q.renderer)?h.isPlainObject(q.renderer)&&!q.renderer.header&&(q.renderer.header="jqueryui"):q.renderer="jqueryui":h.extend(i,o.ext.classes,d.oClasses);p.addClass(i.sTable);if(""!==q.oScroll.sX||""!==q.oScroll.sY)q.oScroll.iBarWidth=Hb();!0===q.oScroll.sX&&
(q.oScroll.sX="100%");q.iInitDisplayStart===k&&(q.iInitDisplayStart=d.iDisplayStart,q._iDisplayStart=d.iDisplayStart);null!==d.iDeferLoading&&(q.bDeferLoading=!0,g=h.isArray(d.iDeferLoading),q._iRecordsDisplay=g?d.iDeferLoading[0]:d.iDeferLoading,q._iRecordsTotal=g?d.iDeferLoading[1]:d.iDeferLoading);var t=q.oLanguage;h.extend(!0,t,d.oLanguage);""!==t.sUrl&&(h.ajax({dataType:"json",url:t.sUrl,success:function(a){O(a);H(l.oLanguage,a);h.extend(true,t,a);ga(q)},error:function(){ga(q)}}),m=!0);null===
d.asStripeClasses&&(q.asStripeClasses=[i.sStripeOdd,i.sStripeEven]);var g=q.asStripeClasses,s=h("tbody tr",this).eq(0);-1!==h.inArray(!0,h.map(g,function(a){return s.hasClass(a)}))&&(h("tbody tr",this).removeClass(g.join(" ")),q.asDestroyStripes=g.slice());n=[];g=this.getElementsByTagName("thead");0!==g.length&&(da(q.aoHeader,g[0]),n=qa(q));if(null===d.aoColumns){r=[];g=0;for(j=n.length;g<j;g++)r.push(null)}else r=d.aoColumns;g=0;for(j=r.length;g<j;g++)Fa(q,n?n[g]:null);ib(q,d.aoColumnDefs,r,function(a,
b){ka(q,a,b)});if(s.length){var u=function(a,b){return a.getAttribute("data-"+b)!==null?b:null};h.each(na(q,s[0]).cells,function(a,b){var c=q.aoColumns[a];if(c.mData===a){var e=u(b,"sort")||u(b,"order"),d=u(b,"filter")||u(b,"search");if(e!==null||d!==null){c.mData={_:a+".display",sort:e!==null?a+".@data-"+e:k,type:e!==null?a+".@data-"+e:k,filter:d!==null?a+".@data-"+d:k};ka(q,a)}}})}var v=q.oFeatures;d.bStateSave&&(v.bStateSave=!0,Kb(q,d),z(q,"aoDrawCallback",ya,"state_save"));if(d.aaSorting===k){n=
q.aaSorting;g=0;for(j=n.length;g<j;g++)n[g][1]=q.aoColumns[g].asSorting[0]}xa(q);v.bSort&&z(q,"aoDrawCallback",function(){if(q.bSorted){var a=T(q),b={};h.each(a,function(a,c){b[c.src]=c.dir});w(q,null,"order",[q,a,b]);Jb(q)}});z(q,"aoDrawCallback",function(){(q.bSorted||B(q)==="ssp"||v.bDeferRender)&&xa(q)},"sc");gb(q);g=p.children("caption").each(function(){this._captionSide=p.css("caption-side")});j=p.children("thead");0===j.length&&(j=h("<thead/>").appendTo(this));q.nTHead=j[0];j=p.children("tbody");
0===j.length&&(j=h("<tbody/>").appendTo(this));q.nTBody=j[0];j=p.children("tfoot");if(0===j.length&&0<g.length&&(""!==q.oScroll.sX||""!==q.oScroll.sY))j=h("<tfoot/>").appendTo(this);0===j.length||0===j.children().length?p.addClass(i.sNoFooter):0<j.length&&(q.nTFoot=j[0],da(q.aoFooter,q.nTFoot));if(d.aaData)for(g=0;g<d.aaData.length;g++)J(q,d.aaData[g]);else(q.bDeferLoading||"dom"==B(q))&&ma(q,h(q.nTBody).children("tr"));q.aiDisplay=q.aiDisplayMaster.slice();q.bInitialised=!0;!1===m&&ga(q)}});b=null;
return this};var Tb=[],v=Array.prototype,cc=function(a){var b,c,e=o.settings,d=h.map(e,function(a){return a.nTable});if(a){if(a.nTable&&a.oApi)return[a];if(a.nodeName&&"table"===a.nodeName.toLowerCase())return b=h.inArray(a,d),-1!==b?[e[b]]:null;if(a&&"function"===typeof a.settings)return a.settings().toArray();"string"===typeof a?c=h(a):a instanceof h&&(c=a)}else return[];if(c)return c.map(function(){b=h.inArray(this,d);return-1!==b?e[b]:null}).toArray()};t=function(a,b){if(!this instanceof t)throw"DT API must be constructed as a new object";
var c=[],e=function(a){(a=cc(a))&&c.push.apply(c,a)};if(h.isArray(a))for(var d=0,f=a.length;d<f;d++)e(a[d]);else e(a);this.context=Na(c);b&&this.push.apply(this,b.toArray?b.toArray():b);this.selector={rows:null,cols:null,opts:null};t.extend(this,this,Tb)};o.Api=t;t.prototype={concat:v.concat,context:[],each:function(a){for(var b=0,c=this.length;b<c;b++)a.call(this,this[b],b,this);return this},eq:function(a){var b=this.context;return b.length>a?new t(b[a],this[a]):null},filter:function(a){var b=[];
if(v.filter)b=v.filter.call(this,a,this);else for(var c=0,e=this.length;c<e;c++)a.call(this,this[c],c,this)&&b.push(this[c]);return new t(this.context,b)},flatten:function(){var a=[];return new t(this.context,a.concat.apply(a,this.toArray()))},join:v.join,indexOf:v.indexOf||function(a,b){for(var c=b||0,e=this.length;c<e;c++)if(this[c]===a)return c;return-1},iterator:function(a,b,c,e){var d=[],f,g,h,i,m,l=this.context,p,n,o=this.selector;"string"===typeof a&&(e=c,c=b,b=a,a=!1);g=0;for(h=l.length;g<
h;g++){var q=new t(l[g]);if("table"===b)f=c.call(q,l[g],g),f!==k&&d.push(f);else if("columns"===b||"rows"===b)f=c.call(q,l[g],this[g],g),f!==k&&d.push(f);else if("column"===b||"column-rows"===b||"row"===b||"cell"===b){n=this[g];"column-rows"===b&&(p=Ca(l[g],o.opts));i=0;for(m=n.length;i<m;i++)f=n[i],f="cell"===b?c.call(q,l[g],f.row,f.column,g,i):c.call(q,l[g],f,g,i,p),f!==k&&d.push(f)}}return d.length||e?(a=new t(l,a?d.concat.apply([],d):d),b=a.selector,b.rows=o.rows,b.cols=o.cols,b.opts=o.opts,a):
this},lastIndexOf:v.lastIndexOf||function(a,b){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(a){var b=[];if(v.map)b=v.map.call(this,a,this);else for(var c=0,e=this.length;c<e;c++)b.push(a.call(this,this[c],c));return new t(this.context,b)},pluck:function(a){return this.map(function(b){return b[a]})},pop:v.pop,push:v.push,reduce:v.reduce||function(a,b){return hb(this,a,b,0,this.length,1)},reduceRight:v.reduceRight||function(a,b){return hb(this,a,b,this.length-1,
-1,-1)},reverse:v.reverse,selector:null,shift:v.shift,sort:v.sort,splice:v.splice,toArray:function(){return v.slice.call(this)},to$:function(){return h(this)},toJQuery:function(){return h(this)},unique:function(){return new t(this.context,Na(this))},unshift:v.unshift};t.extend=function(a,b,c){if(c.length&&b&&(b instanceof t||b.__dt_wrapper)){var e,d,f,g=function(a,b,c){return function(){var e=b.apply(a,arguments);t.extend(e,e,c.methodExt);return e}};e=0;for(d=c.length;e<d;e++)f=c[e],b[f.name]="function"===
typeof f.val?g(a,f.val,f):h.isPlainObject(f.val)?{}:f.val,b[f.name].__dt_wrapper=!0,t.extend(a,b[f.name],f.propExt)}};t.register=r=function(a,b){if(h.isArray(a))for(var c=0,e=a.length;c<e;c++)t.register(a[c],b);else for(var d=a.split("."),f=Tb,g,j,c=0,e=d.length;c<e;c++){g=(j=-1!==d[c].indexOf("()"))?d[c].replace("()",""):d[c];var i;a:{i=0;for(var m=f.length;i<m;i++)if(f[i].name===g){i=f[i];break a}i=null}i||(i={name:g,val:{},methodExt:[],propExt:[]},f.push(i));c===e-1?i.val=b:f=j?i.methodExt:i.propExt}};
t.registerPlural=u=function(a,b,c){t.register(a,c);t.register(b,function(){var a=c.apply(this,arguments);return a===this?this:a instanceof t?a.length?h.isArray(a[0])?new t(a.context,a[0]):a[0]:k:a})};r("tables()",function(a){var b;if(a){b=t;var c=this.context;if("number"===typeof a)a=[c[a]];else var e=h.map(c,function(a){return a.nTable}),a=h(e).filter(a).map(function(){var a=h.inArray(this,e);return c[a]}).toArray();b=new b(a)}else b=this;return b});r("table()",function(a){var a=this.tables(a),b=
a.context;return b.length?new t(b[0]):a});u("tables().nodes()","table().node()",function(){return this.iterator("table",function(a){return a.nTable},1)});u("tables().body()","table().body()",function(){return this.iterator("table",function(a){return a.nTBody},1)});u("tables().header()","table().header()",function(){return this.iterator("table",function(a){return a.nTHead},1)});u("tables().footer()","table().footer()",function(){return this.iterator("table",function(a){return a.nTFoot},1)});u("tables().containers()",
"table().container()",function(){return this.iterator("table",function(a){return a.nTableWrapper},1)});r("draw()",function(a){return this.iterator("table",function(b){N(b,!1===a)})});r("page()",function(a){return a===k?this.page.info().page:this.iterator("table",function(b){Ta(b,a)})});r("page.info()",function(){if(0===this.context.length)return k;var a=this.context[0],b=a._iDisplayStart,c=a._iDisplayLength,e=a.fnRecordsDisplay(),d=-1===c;return{page:d?0:Math.floor(b/c),pages:d?1:Math.ceil(e/c),start:b,
end:a.fnDisplayEnd(),length:c,recordsTotal:a.fnRecordsTotal(),recordsDisplay:e}});r("page.len()",function(a){return a===k?0!==this.context.length?this.context[0]._iDisplayLength:k:this.iterator("table",function(b){Ra(b,a)})});var Ub=function(a,b,c){"ssp"==B(a)?N(a,b):(C(a,!0),ra(a,[],function(c){oa(a);for(var c=sa(a,c),e=0,g=c.length;e<g;e++)J(a,c[e]);N(a,b);C(a,!1)}));if(c){var e=new t(a);e.one("draw",function(){c(e.ajax.json())})}};r("ajax.json()",function(){var a=this.context;if(0<a.length)return a[0].json});
r("ajax.params()",function(){var a=this.context;if(0<a.length)return a[0].oAjaxData});r("ajax.reload()",function(a,b){return this.iterator("table",function(c){Ub(c,!1===b,a)})});r("ajax.url()",function(a){var b=this.context;if(a===k){if(0===b.length)return k;b=b[0];return b.ajax?h.isPlainObject(b.ajax)?b.ajax.url:b.ajax:b.sAjaxSource}return this.iterator("table",function(b){h.isPlainObject(b.ajax)?b.ajax.url=a:b.ajax=a})});r("ajax.url().load()",function(a,b){return this.iterator("table",function(c){Ub(c,
!1===b,a)})});var $a=function(a,b){var c=[],e,d,f,g,j,i;e=typeof a;if(!a||"string"===e||"function"===e||a.length===k)a=[a];f=0;for(g=a.length;f<g;f++){d=a[f]&&a[f].split?a[f].split(","):[a[f]];j=0;for(i=d.length;j<i;j++)(e=b("string"===typeof d[j]?h.trim(d[j]):d[j]))&&e.length&&c.push.apply(c,e)}return c},ab=function(a){a||(a={});a.filter&&!a.search&&(a.search=a.filter);return{search:a.search||"none",order:a.order||"current",page:a.page||"all"}},bb=function(a){for(var b=0,c=a.length;b<c;b++)if(0<
a[b].length)return a[0]=a[b],a.length=1,a.context=[a.context[b]],a;a.length=0;return a},Ca=function(a,b){var c,e,d,f=[],g=a.aiDisplay;c=a.aiDisplayMaster;var j=b.search;e=b.order;d=b.page;if("ssp"==B(a))return"removed"===j?[]:U(0,c.length);if("current"==d){c=a._iDisplayStart;for(e=a.fnDisplayEnd();c<e;c++)f.push(g[c])}else if("current"==e||"applied"==e)f="none"==j?c.slice():"applied"==j?g.slice():h.map(c,function(a){return-1===h.inArray(a,g)?a:null});else if("index"==e||"original"==e){c=0;for(e=a.aoData.length;c<
e;c++)"none"==j?f.push(c):(d=h.inArray(c,g),(-1===d&&"removed"==j||0<=d&&"applied"==j)&&f.push(c))}return f};r("rows()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=ab(b),c=this.iterator("table",function(c){var d=b;return $a(a,function(a){var b=Pb(a);if(b!==null&&!d)return[b];var j=Ca(c,d);if(b!==null&&h.inArray(b,j)!==-1)return[b];if(!a)return j;if(typeof a==="function")return h.map(j,function(b){var d=c.aoData[b];return a(b,d._aData,d.nTr)?b:null});b=Sb(ia(c.aoData,j,"nTr"));return a.nodeName&&
h.inArray(a,b)!==-1?[a._DT_RowIndex]:h(b).filter(a).map(function(){return this._DT_RowIndex}).toArray()})},1);c.selector.rows=a;c.selector.opts=b;return c});r("rows().nodes()",function(){return this.iterator("row",function(a,b){return a.aoData[b].nTr||k},1)});r("rows().data()",function(){return this.iterator(!0,"rows",function(a,b){return ia(a.aoData,b,"_aData")},1)});u("rows().cache()","row().cache()",function(a){return this.iterator("row",function(b,c){var e=b.aoData[c];return"search"===a?e._aFilterData:
e._aSortData},1)});u("rows().invalidate()","row().invalidate()",function(a){return this.iterator("row",function(b,c){ca(b,c,a)})});u("rows().indexes()","row().index()",function(){return this.iterator("row",function(a,b){return b},1)});u("rows().remove()","row().remove()",function(){var a=this;return this.iterator("row",function(b,c,e){var d=b.aoData;d.splice(c,1);for(var f=0,g=d.length;f<g;f++)null!==d[f].nTr&&(d[f].nTr._DT_RowIndex=f);h.inArray(c,b.aiDisplay);pa(b.aiDisplayMaster,c);pa(b.aiDisplay,
c);pa(a[e],c,!1);Sa(b)})});r("rows.add()",function(a){var b=this.iterator("table",function(b){var c,f,g,h=[];f=0;for(g=a.length;f<g;f++)c=a[f],c.nodeName&&"TR"===c.nodeName.toUpperCase()?h.push(ma(b,c)[0]):h.push(J(b,c));return h},1),c=this.rows(-1);c.pop();c.push.apply(c,b.toArray());return c});r("row()",function(a,b){return bb(this.rows(a,b))});r("row().data()",function(a){var b=this.context;if(a===k)return b.length&&this.length?b[0].aoData[this[0]]._aData:k;b[0].aoData[this[0]]._aData=a;ca(b[0],
this[0],"data");return this});r("row().node()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]].nTr||null:null});r("row.add()",function(a){a instanceof h&&a.length&&(a=a[0]);var b=this.iterator("table",function(b){return a.nodeName&&"TR"===a.nodeName.toUpperCase()?ma(b,a)[0]:J(b,a)});return this.row(b[0])});var cb=function(a,b){var c=a.context;c.length&&(c=c[0].aoData[b!==k?b:a[0]],c._details&&(c._details.remove(),c._detailsShow=k,c._details=k))},Vb=function(a,b){var c=
a.context;if(c.length&&a.length){var e=c[0].aoData[a[0]];if(e._details){(e._detailsShow=b)?e._details.insertAfter(e.nTr):e._details.detach();var d=c[0],f=new t(d),g=d.aoData;f.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");0<D(g,"_details").length&&(f.on("draw.dt.DT_details",function(a,b){d===b&&f.rows({page:"current"}).eq(0).each(function(a){a=g[a];a._detailsShow&&a._details.insertAfter(a.nTr)})}),f.on("column-visibility.dt.DT_details",function(a,b){if(d===b)for(var c,
e=aa(b),f=0,h=g.length;f<h;f++)c=g[f],c._details&&c._details.children("td[colspan]").attr("colspan",e)}),f.on("destroy.dt.DT_details",function(a,b){if(d===b)for(var c=0,e=g.length;c<e;c++)g[c]._details&&cb(f,c)}))}}};r("row().child()",function(a,b){var c=this.context;if(a===k)return c.length&&this.length?c[0].aoData[this[0]]._details:k;if(!0===a)this.child.show();else if(!1===a)cb(this);else if(c.length&&this.length){var e=c[0],c=c[0].aoData[this[0]],d=[],f=function(a,b){if(a.nodeName&&"tr"===a.nodeName.toLowerCase())d.push(a);
else{var c=h("<tr><td/></tr>").addClass(b);h("td",c).addClass(b).html(a)[0].colSpan=aa(e);d.push(c[0])}};if(h.isArray(a)||a instanceof h)for(var g=0,j=a.length;g<j;g++)f(a[g],b);else f(a,b);c._details&&c._details.remove();c._details=h(d);c._detailsShow&&c._details.insertAfter(c.nTr)}return this});r(["row().child.show()","row().child().show()"],function(){Vb(this,!0);return this});r(["row().child.hide()","row().child().hide()"],function(){Vb(this,!1);return this});r(["row().child.remove()","row().child().remove()"],
function(){cb(this);return this});r("row().child.isShown()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]]._detailsShow||!1:!1});var dc=/^(.+):(name|visIdx|visible)$/,Wb=function(a,b,c,e,d){for(var c=[],e=0,f=d.length;e<f;e++)c.push(y(a,d[e],b));return c};r("columns()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=ab(b),c=this.iterator("table",function(c){var d=a,f=b,g=c.aoColumns,j=D(g,"sName"),i=D(g,"nTh");return $a(d,function(a){var b=Pb(a);if(a===
"")return U(g.length);if(b!==null)return[b>=0?b:g.length+b];if(typeof a==="function"){var d=Ca(c,f);return h.map(g,function(b,f){return a(f,Wb(c,f,0,0,d),i[f])?f:null})}var k=typeof a==="string"?a.match(dc):"";if(k)switch(k[2]){case "visIdx":case "visible":b=parseInt(k[1],10);if(b<0){var o=h.map(g,function(a,b){return a.bVisible?b:null});return[o[o.length+b]]}return[la(c,b)];case "name":return h.map(j,function(a,b){return a===k[1]?b:null})}else return h(i).filter(a).map(function(){return h.inArray(this,
i)}).toArray()})},1);c.selector.cols=a;c.selector.opts=b;return c});u("columns().header()","column().header()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTh},1)});u("columns().footer()","column().footer()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTf},1)});u("columns().data()","column().data()",function(){return this.iterator("column-rows",Wb,1)});u("columns().dataSrc()","column().dataSrc()",function(){return this.iterator("column",
function(a,b){return a.aoColumns[b].mData},1)});u("columns().cache()","column().cache()",function(a){return this.iterator("column-rows",function(b,c,e,d,f){return ia(b.aoData,f,"search"===a?"_aFilterData":"_aSortData",c)},1)});u("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(a,b,c,e,d){return ia(a.aoData,d,"anCells",b)},1)});u("columns().visible()","column().visible()",function(a,b){return this.iterator("column",function(c,e){if(a===k)return c.aoColumns[e].bVisible;
var d=c.aoColumns,f=d[e],g=c.aoData,j,i,m;if(a!==k&&f.bVisible!==a){if(a){var l=h.inArray(!0,D(d,"bVisible"),e+1);j=0;for(i=g.length;j<i;j++)m=g[j].nTr,d=g[j].anCells,m&&m.insertBefore(d[e],d[l]||null)}else h(D(c.aoData,"anCells",e)).detach();f.bVisible=a;ea(c,c.aoHeader);ea(c,c.aoFooter);if(b===k||b)X(c),(c.oScroll.sX||c.oScroll.sY)&&Y(c);w(c,null,"column-visibility",[c,e,a]);ya(c)}})});u("columns().indexes()","column().index()",function(a){return this.iterator("column",function(b,c){return"visible"===
a?$(b,c):c},1)});r("columns.adjust()",function(){return this.iterator("table",function(a){X(a)},1)});r("column.index()",function(a,b){if(0!==this.context.length){var c=this.context[0];if("fromVisible"===a||"toData"===a)return la(c,b);if("fromData"===a||"toVisible"===a)return $(c,b)}});r("column()",function(a,b){return bb(this.columns(a,b))});r("cells()",function(a,b,c){h.isPlainObject(a)&&(typeof a.row!==k?(c=b,b=null):(c=a,a=null));h.isPlainObject(b)&&(c=b,b=null);if(null===b||b===k)return this.iterator("table",
function(b){var e=a,d=ab(c),f=b.aoData,g=Ca(b,d),d=Sb(ia(f,g,"anCells")),j=h([].concat.apply([],d)),i,l=b.aoColumns.length,m,o,r,t,s,u;return $a(e,function(a){var c=typeof a==="function";if(a===null||a===k||c){m=[];o=0;for(r=g.length;o<r;o++){i=g[o];for(t=0;t<l;t++){s={row:i,column:t};if(c){u=b.aoData[i];a(s,y(b,i,t),u.anCells[t])&&m.push(s)}else m.push(s)}}return m}return h.isPlainObject(a)?[a]:j.filter(a).map(function(a,b){i=b.parentNode._DT_RowIndex;return{row:i,column:h.inArray(b,f[i].anCells)}}).toArray()})});
var e=this.columns(b,c),d=this.rows(a,c),f,g,j,i,m,l=this.iterator("table",function(a,b){f=[];g=0;for(j=d[b].length;g<j;g++){i=0;for(m=e[b].length;i<m;i++)f.push({row:d[b][g],column:e[b][i]})}return f},1);h.extend(l.selector,{cols:b,rows:a,opts:c});return l});u("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(a,b,c){return(a=a.aoData[b].anCells)?a[c]:k},1)});r("cells().data()",function(){return this.iterator("cell",function(a,b,c){return y(a,b,c)},1)});u("cells().cache()",
"cell().cache()",function(a){a="search"===a?"_aFilterData":"_aSortData";return this.iterator("cell",function(b,c,e){return b.aoData[c][a][e]},1)});u("cells().render()","cell().render()",function(a){return this.iterator("cell",function(b,c,e){return y(b,c,e,a)},1)});u("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(a,b,c){return{row:b,column:c,columnVisible:$(a,c)}},1)});u("cells().invalidate()","cell().invalidate()",function(a){return this.iterator("cell",function(b,
c,e){ca(b,c,a,e)})});r("cell()",function(a,b,c){return bb(this.cells(a,b,c))});r("cell().data()",function(a){var b=this.context,c=this[0];if(a===k)return b.length&&c.length?y(b[0],c[0].row,c[0].column):k;Ia(b[0],c[0].row,c[0].column,a);ca(b[0],c[0].row,"data",c[0].column);return this});r("order()",function(a,b){var c=this.context;if(a===k)return 0!==c.length?c[0].aaSorting:k;"number"===typeof a?a=[[a,b]]:h.isArray(a[0])||(a=Array.prototype.slice.call(arguments));return this.iterator("table",function(b){b.aaSorting=
a.slice()})});r("order.listener()",function(a,b,c){return this.iterator("table",function(e){Oa(e,a,b,c)})});r(["columns().order()","column().order()"],function(a){var b=this;return this.iterator("table",function(c,e){var d=[];h.each(b[e],function(b,c){d.push([c,a])});c.aaSorting=d})});r("search()",function(a,b,c,e){var d=this.context;return a===k?0!==d.length?d[0].oPreviousSearch.sSearch:k:this.iterator("table",function(d){d.oFeatures.bFilter&&fa(d,h.extend({},d.oPreviousSearch,{sSearch:a+"",bRegex:null===
b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===e?!0:e}),1)})});u("columns().search()","column().search()",function(a,b,c,e){return this.iterator("column",function(d,f){var g=d.aoPreSearchCols;if(a===k)return g[f].sSearch;d.oFeatures.bFilter&&(h.extend(g[f],{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===e?!0:e}),fa(d,d.oPreviousSearch,1))})});r("state()",function(){return this.context.length?this.context[0].oSavedState:null});r("state.clear()",function(){return this.iterator("table",
function(a){a.fnStateSaveCallback.call(a.oInstance,a,{})})});r("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null});r("state.save()",function(){return this.iterator("table",function(a){ya(a)})});o.versionCheck=o.fnVersionCheck=function(a){for(var b=o.version.split("."),a=a.split("."),c,e,d=0,f=a.length;d<f;d++)if(c=parseInt(b[d],10)||0,e=parseInt(a[d],10)||0,c!==e)return c>e;return!0};o.isDataTable=o.fnIsDataTable=function(a){var b=h(a).get(0),c=!1;h.each(o.settings,
function(a,d){if(d.nTable===b||h("table",d.nScrollHead)[0]===b||h("table",d.nScrollFoot)[0]===b)c=!0});return c};o.tables=o.fnTables=function(a){return h.map(o.settings,function(b){if(!a||a&&h(b.nTable).is(":visible"))return b.nTable})};o.util={throttle:ua,escapeRegex:va};o.camelToHungarian=H;r("$()",function(a,b){var c=this.rows(b).nodes(),c=h(c);return h([].concat(c.filter(a).toArray(),c.find(a).toArray()))});h.each(["on","one","off"],function(a,b){r(b+"()",function(){var a=Array.prototype.slice.call(arguments);
a[0].match(/\.dt\b/)||(a[0]+=".dt");var e=h(this.tables().nodes());e[b].apply(e,a);return this})});r("clear()",function(){return this.iterator("table",function(a){oa(a)})});r("settings()",function(){return new t(this.context,this.context)});r("data()",function(){return this.iterator("table",function(a){return D(a.aoData,"_aData")}).flatten()});r("destroy()",function(a){a=a||!1;return this.iterator("table",function(b){var c=b.nTableWrapper.parentNode,e=b.oClasses,d=b.nTable,f=b.nTBody,g=b.nTHead,j=
b.nTFoot,i=h(d),f=h(f),k=h(b.nTableWrapper),l=h.map(b.aoData,function(a){return a.nTr}),p;b.bDestroying=!0;w(b,"aoDestroyCallback","destroy",[b]);a||(new t(b)).columns().visible(!0);k.unbind(".DT").find(":not(tbody *)").unbind(".DT");h(Ea).unbind(".DT-"+b.sInstance);d!=g.parentNode&&(i.children("thead").detach(),i.append(g));j&&d!=j.parentNode&&(i.children("tfoot").detach(),i.append(j));i.detach();k.detach();b.aaSorting=[];b.aaSortingFixed=[];xa(b);h(l).removeClass(b.asStripeClasses.join(" "));h("th, td",
g).removeClass(e.sSortable+" "+e.sSortableAsc+" "+e.sSortableDesc+" "+e.sSortableNone);b.bJUI&&(h("th span."+e.sSortIcon+", td span."+e.sSortIcon,g).detach(),h("th, td",g).each(function(){var a=h("div."+e.sSortJUIWrapper,this);h(this).append(a.contents());a.detach()}));!a&&c&&c.insertBefore(d,b.nTableReinsertBefore);f.children().detach();f.append(l);i.css("width",b.sDestroyWidth).removeClass(e.sTable);(p=b.asDestroyStripes.length)&&f.children().each(function(a){h(this).addClass(b.asDestroyStripes[a%
p])});c=h.inArray(b,o.settings);-1!==c&&o.settings.splice(c,1)})});o.version="1.10.5";o.settings=[];o.models={};o.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0};o.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null};o.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,
nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null};o.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bJQueryUI:!1,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,
bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(a){return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(a){try{return JSON.parse((-1===a.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+
a.sInstance+"_"+location.pathname))}catch(b){}},fnStateLoadParams:null,fnStateLoaded:null,fnStateSaveCallback:function(a,b){try{(-1===a.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+a.sInstance+"_"+location.pathname,JSON.stringify(b))}catch(c){}},fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",sSortDescending:": activate to sort column descending"},
oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"Processing...",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},oSearch:h.extend({},
o.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",searchDelay:null,sPaginationType:"simple_numbers",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null};V(o.defaults);o.defaults.column={aDataSort:null,iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null};V(o.defaults.column);
o.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:null,bLengthChange:null,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],
aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,searchDelay:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],
aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,bAjaxDataGet:!0,jqXHR:null,json:k,oAjaxData:k,fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,bJUI:null,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==B(this)?1*this._iRecordsTotal:this.aiDisplayMaster.length},
fnRecordsDisplay:function(){return"ssp"==B(this)?1*this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var a=this._iDisplayLength,b=this._iDisplayStart,c=b+a,e=this.aiDisplay.length,d=this.oFeatures,f=d.bPaginate;return d.bServerSide?!1===f||-1===a?b+e:Math.min(b+a,this._iRecordsDisplay):!f||c>e||-1===a?e:c},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{}};o.ext=x={buttons:{},classes:{},errMode:"alert",feature:[],search:[],internal:{},
legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:o.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:o.version};h.extend(x,{afnFiltering:x.search,aTypes:x.type.detect,ofnSearch:x.type.search,oSort:x.type.order,afnSortData:x.order,aoFeatures:x.feature,oApi:x.internal,oStdClasses:x.classes,oPagination:x.pager});h.extend(o.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",
sPageButtonDisabled:"disabled",sStripeOdd:"odd",sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",sSortable:"sorting",sSortableAsc:"sorting_asc_disabled",sSortableDesc:"sorting_desc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",
sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""});var Da="",Da="",F=Da+"ui-state-default",ja=Da+"css_right ui-icon ui-icon-",Xb=Da+"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix";
h.extend(o.ext.oJUIClasses,o.ext.classes,{sPageButton:"fg-button ui-button "+F,sPageButtonActive:"ui-state-disabled",sPageButtonDisabled:"ui-state-disabled",sPaging:"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",sSortAsc:F+" sorting_asc",sSortDesc:F+" sorting_desc",sSortable:F+" sorting",sSortableAsc:F+" sorting_asc_disabled",sSortableDesc:F+" sorting_desc_disabled",sSortableNone:F+" sorting_disabled",sSortJUIAsc:ja+"triangle-1-n",sSortJUIDesc:ja+"triangle-1-s",
sSortJUI:ja+"carat-2-n-s",sSortJUIAscAllowed:ja+"carat-1-n",sSortJUIDescAllowed:ja+"carat-1-s",sSortJUIWrapper:"DataTables_sort_wrapper",sSortIcon:"DataTables_sort_icon",sScrollHead:"dataTables_scrollHead "+F,sScrollFoot:"dataTables_scrollFoot "+F,sHeaderTH:F,sFooterTH:F,sJUIHeader:Xb+" ui-corner-tl ui-corner-tr",sJUIFooter:Xb+" ui-corner-bl ui-corner-br"});var Mb=o.ext.pager;h.extend(Mb,{simple:function(){return["previous","next"]},full:function(){return["first","previous","next","last"]},simple_numbers:function(a,
b){return["previous",Wa(a,b),"next"]},full_numbers:function(a,b){return["first","previous",Wa(a,b),"next","last"]},_numbers:Wa,numbers_length:7});h.extend(!0,o.ext.renderer,{pageButton:{_:function(a,b,c,e,d,f){var g=a.oClasses,j=a.oLanguage.oPaginate,i,k,l=0,o=function(b,e){var n,r,t,s,u=function(b){Ta(a,b.data.action,true)};n=0;for(r=e.length;n<r;n++){s=e[n];if(h.isArray(s)){t=h("<"+(s.DT_el||"div")+"/>").appendTo(b);o(t,s)}else{k=i="";switch(s){case "ellipsis":b.append("<span>&hellip;</span>");
break;case "first":i=j.sFirst;k=s+(d>0?"":" "+g.sPageButtonDisabled);break;case "previous":i=j.sPrevious;k=s+(d>0?"":" "+g.sPageButtonDisabled);break;case "next":i=j.sNext;k=s+(d<f-1?"":" "+g.sPageButtonDisabled);break;case "last":i=j.sLast;k=s+(d<f-1?"":" "+g.sPageButtonDisabled);break;default:i=s+1;k=d===s?g.sPageButtonActive:""}if(i){t=h("<a>",{"class":g.sPageButton+" "+k,"aria-controls":a.sTableId,"data-dt-idx":l,tabindex:a.iTabIndex,id:c===0&&typeof s==="string"?a.sTableId+"_"+s:null}).html(i).appendTo(b);
Va(t,{action:s},u);l++}}}},n;try{n=h(P.activeElement).data("dt-idx")}catch(r){}o(h(b).empty(),e);n&&h(b).find("[data-dt-idx="+n+"]").focus()}}});h.extend(o.ext.type.detect,[function(a,b){var c=b.oLanguage.sDecimal;return Za(a,c)?"num"+c:null},function(a){if(a&&!(a instanceof Date)&&(!ac.test(a)||!bc.test(a)))return null;var b=Date.parse(a);return null!==b&&!isNaN(b)||I(a)?"date":null},function(a,b){var c=b.oLanguage.sDecimal;return Za(a,c,!0)?"num-fmt"+c:null},function(a,b){var c=b.oLanguage.sDecimal;
return Rb(a,c)?"html-num"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Rb(a,c,!0)?"html-num-fmt"+c:null},function(a){return I(a)||"string"===typeof a&&-1!==a.indexOf("<")?"html":null}]);h.extend(o.ext.type.search,{html:function(a){return I(a)?a:"string"===typeof a?a.replace(Ob," ").replace(Ba,""):""},string:function(a){return I(a)?a:"string"===typeof a?a.replace(Ob," "):a}});var Aa=function(a,b,c,e){if(0!==a&&(!a||"-"===a))return-Infinity;b&&(a=Qb(a,b));a.replace&&(c&&(a=a.replace(c,"")),
e&&(a=a.replace(e,"")));return 1*a};h.extend(x.type.order,{"date-pre":function(a){return Date.parse(a)||0},"html-pre":function(a){return I(a)?"":a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+""},"string-pre":function(a){return I(a)?"":"string"===typeof a?a.toLowerCase():!a.toString?"":a.toString()},"string-asc":function(a,b){return a<b?-1:a>b?1:0},"string-desc":function(a,b){return a<b?1:a>b?-1:0}});db("");h.extend(!0,o.ext.renderer,{header:{_:function(a,b,c,e){h(a.nTable).on("order.dt.DT",function(d,
f,g,h){if(a===f){d=c.idx;b.removeClass(c.sSortingClass+" "+e.sSortAsc+" "+e.sSortDesc).addClass(h[d]=="asc"?e.sSortAsc:h[d]=="desc"?e.sSortDesc:c.sSortingClass)}})},jqueryui:function(a,b,c,e){h("<div/>").addClass(e.sSortJUIWrapper).append(b.contents()).append(h("<span/>").addClass(e.sSortIcon+" "+c.sSortingClassJUI)).appendTo(b);h(a.nTable).on("order.dt.DT",function(d,f,g,h){if(a===f){d=c.idx;b.removeClass(e.sSortAsc+" "+e.sSortDesc).addClass(h[d]=="asc"?e.sSortAsc:h[d]=="desc"?e.sSortDesc:c.sSortingClass);
b.find("span."+e.sSortIcon).removeClass(e.sSortJUIAsc+" "+e.sSortJUIDesc+" "+e.sSortJUI+" "+e.sSortJUIAscAllowed+" "+e.sSortJUIDescAllowed).addClass(h[d]=="asc"?e.sSortJUIAsc:h[d]=="desc"?e.sSortJUIDesc:c.sSortingClassJUI)}})}}});o.render={number:function(a,b,c,e){return{display:function(d){var f=0>d?"-":"",d=Math.abs(parseFloat(d)),g=parseInt(d,10),d=c?b+(d-g).toFixed(c).substring(2):"";return f+(e||"")+g.toString().replace(/\B(?=(\d{3})+(?!\d))/g,a)+d}}}};h.extend(o.ext.internal,{_fnExternApiFunc:Nb,
_fnBuildAjax:ra,_fnAjaxUpdate:kb,_fnAjaxParameters:tb,_fnAjaxUpdateDraw:ub,_fnAjaxDataSrc:sa,_fnAddColumn:Fa,_fnColumnOptions:ka,_fnAdjustColumnSizing:X,_fnVisibleToColumnIndex:la,_fnColumnIndexToVisible:$,_fnVisbleColumns:aa,_fnGetColumns:Z,_fnColumnTypes:Ha,_fnApplyColumnDefs:ib,_fnHungarianMap:V,_fnCamelToHungarian:H,_fnLanguageCompat:O,_fnBrowserDetect:gb,_fnAddData:J,_fnAddTr:ma,_fnNodeToDataIndex:function(a,b){return b._DT_RowIndex!==k?b._DT_RowIndex:null},_fnNodeToColumnIndex:function(a,b,
c){return h.inArray(c,a.aoData[b].anCells)},_fnGetCellData:y,_fnSetCellData:Ia,_fnSplitObjNotation:Ka,_fnGetObjectDataFn:W,_fnSetObjectDataFn:Q,_fnGetDataMaster:La,_fnClearTable:oa,_fnDeleteIndex:pa,_fnInvalidate:ca,_fnGetRowElements:na,_fnCreateTr:Ja,_fnBuildHead:jb,_fnDrawHead:ea,_fnDraw:M,_fnReDraw:N,_fnAddOptionsHtml:mb,_fnDetectHeader:da,_fnGetUniqueThs:qa,_fnFeatureHtmlFilter:ob,_fnFilterComplete:fa,_fnFilterCustom:xb,_fnFilterColumn:wb,_fnFilter:vb,_fnFilterCreateSearch:Qa,_fnEscapeRegex:va,
_fnFilterData:yb,_fnFeatureHtmlInfo:rb,_fnUpdateInfo:Bb,_fnInfoMacros:Cb,_fnInitialise:ga,_fnInitComplete:ta,_fnLengthChange:Ra,_fnFeatureHtmlLength:nb,_fnFeatureHtmlPaginate:sb,_fnPageChange:Ta,_fnFeatureHtmlProcessing:pb,_fnProcessingDisplay:C,_fnFeatureHtmlTable:qb,_fnScrollDraw:Y,_fnApplyToChildren:G,_fnCalculateColumnWidths:Ga,_fnThrottle:ua,_fnConvertToWidth:Db,_fnScrollingWidthAdjust:Fb,_fnGetWidestNode:Eb,_fnGetMaxLenString:Gb,_fnStringToCss:s,_fnScrollBarWidth:Hb,_fnSortFlatten:T,_fnSort:lb,
_fnSortAria:Jb,_fnSortListener:Ua,_fnSortAttachListener:Oa,_fnSortingClasses:xa,_fnSortData:Ib,_fnSaveState:ya,_fnLoadState:Kb,_fnSettingsFromNode:za,_fnLog:R,_fnMap:E,_fnBindAction:Va,_fnCallbackReg:z,_fnCallbackFire:w,_fnLengthOverflow:Sa,_fnRenderer:Pa,_fnDataSource:B,_fnRowAttributes:Ma,_fnCalculateEnd:function(){}});h.fn.dataTable=o;h.fn.dataTableSettings=o.settings;h.fn.dataTableExt=o.ext;h.fn.DataTable=function(a){return h(this).dataTable(a).api()};h.each(o,function(a,b){h.fn.DataTable[a]=
b});return h.fn.dataTable};"function"===typeof define&&define.amd?define("datatables",["jquery"],O):"object"===typeof exports?module.exports=O(require("jquery")):jQuery&&!jQuery.fn.dataTable&&O(jQuery)})(window,document);

!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(window.jQuery)
}(function (a) {
    Array.prototype.reduce || (Array.prototype.reduce = function (a) {
        var b, c = Object(this), d = c.length >>> 0, e = 0;
        if (2 === arguments.length)b = arguments[1]; else {
            for (; d > e && !(e in c);)e++;
            if (e >= d)throw new TypeError("Reduce of empty array with no initial value");
            b = c[e++]
        }
        for (; d > e; e++)e in c && (b = a(b, c[e], e, c));
        return b
    }), "function" != typeof Array.prototype.filter && (Array.prototype.filter = function (a) {
        for (var b = Object(this), c = b.length >>> 0, d = [], e = arguments.length >= 2 ? arguments[1] : void 0, f = 0; c > f; f++)if (f in b) {
            var g = b[f];
            a.call(e, g, f, b) && d.push(g)
        }
        return d
    });
    var b, c = "function" == typeof define && define.amd, d = function (b) {
        var c = "Comic Sans MS" === b ? "Courier New" : "Comic Sans MS", d = a("<div>").css({
            position: "absolute",
            left: "-9999px",
            top: "-9999px",
            fontSize: "200px"
        }).text("mmmmmmmmmwwwwwww").appendTo(document.body), e = d.css("fontFamily", c).width(), f = d.css("fontFamily", b + "," + c).width();
        return d.remove(), e !== f
    }, e = {
        isMac: navigator.appVersion.indexOf("Mac") > -1,
        isMSIE: navigator.userAgent.indexOf("MSIE") > -1 || navigator.userAgent.indexOf("Trident") > -1,
        isFF: navigator.userAgent.indexOf("Firefox") > -1,
        jqueryVersion: parseFloat(a.fn.jquery),
        isSupportAmd: c,
        hasCodeMirror: c ? require.specified("CodeMirror") : !!window.CodeMirror,
        isFontInstalled: d,
        isW3CRangeSupport: !!document.createRange
    }, f = function () {
        var b = function (a) {
            return function (b) {
                return a === b
            }
        }, c = function (a, b) {
            return a === b
        }, d = function (a) {
            return function (b, c) {
                return b[a] === c[a]
            }
        }, e = function () {
            return !0
        }, f = function () {
            return !1
        }, g = function (a) {
            return function () {
                return !a.apply(a, arguments)
            }
        }, h = function (a, b) {
            return function (c) {
                return a(c) && b(c)
            }
        }, i = function (a) {
            return a
        }, j = 0, k = function (a) {
            var b = ++j + "";
            return a ? a + b : b
        }, l = function (b) {
            var c = a(document);
            return {
                top: b.top + c.scrollTop(),
                left: b.left + c.scrollLeft(),
                width: b.right - b.left,
                height: b.bottom - b.top
            }
        }, m = function (a) {
            var b = {};
            for (var c in a)a.hasOwnProperty(c) && (b[a[c]] = c);
            return b
        };
        return {
            eq: b,
            eq2: c,
            peq2: d,
            ok: e,
            fail: f,
            self: i,
            not: g,
            and: h,
            uniqueId: k,
            rect2bnd: l,
            invertObject: m
        }
    }(), g = function () {
        var b = function (a) {
            return a[0]
        }, c = function (a) {
            return a[a.length - 1]
        }, d = function (a) {
            return a.slice(0, a.length - 1)
        }, e = function (a) {
            return a.slice(1)
        }, g = function (a, b) {
            for (var c = 0, d = a.length; d > c; c++) {
                var e = a[c];
                if (b(e))return e
            }
        }, h = function (a, b) {
            for (var c = 0, d = a.length; d > c; c++)if (!b(a[c]))return !1;
            return !0
        }, i = function (b, c) {
            return -1 !== a.inArray(c, b)
        }, j = function (a, b) {
            return b = b || f.self, a.reduce(function (a, c) {
                return a + b(c)
            }, 0)
        }, k = function (a) {
            for (var b = [], c = -1, d = a.length; ++c < d;)b[c] = a[c];
            return b
        }, l = function (a, d) {
            if (!a.length)return [];
            var f = e(a);
            return f.reduce(function (a, b) {
                var e = c(a);
                return d(c(e), b) ? e[e.length] = b : a[a.length] = [b], a
            }, [[b(a)]])
        }, m = function (a) {
            for (var b = [], c = 0, d = a.length; d > c; c++)a[c] && b.push(a[c]);
            return b
        }, n = function (a) {
            for (var b = [], c = 0, d = a.length; d > c; c++)i(b, a[c]) || b.push(a[c]);
            return b
        }, o = function (a, b) {
            var c = a.indexOf(b);
            return -1 === c ? null : a[c + 1]
        }, p = function (a, b) {
            var c = a.indexOf(b);
            return -1 === c ? null : a[c - 1]
        };
        return {
            head: b,
            last: c,
            initial: d,
            tail: e,
            prev: p,
            next: o,
            find: g,
            contains: i,
            all: h,
            sum: j,
            from: k,
            clusterBy: l,
            compact: m,
            unique: n
        }
    }(), h = String.fromCharCode(160), i = "﻿", j = function () {
        var b = function (b) {
            return b && a(b).hasClass("note-editable")
        }, c = function (b) {
            return b && a(b).hasClass("note-control-sizing")
        }, d = function (b) {
            var c;
            if (b.hasClass("note-air-editor")) {
                var d = g.last(b.attr("id").split("-"));
                return c = function (b) {
                    return function () {
                        return a(b + d)
                    }
                }, {
                    editor: function () {
                        return b
                    }, editable: function () {
                        return b
                    }, popover: c("#note-popover-"), handle: c("#note-handle-"), dialog: c("#note-dialog-")
                }
            }
            return c = function (a) {
                return function () {
                    return b.find(a)
                }
            }, {
                editor: function () {
                    return b
                },
                dropzone: c(".note-dropzone"),
                toolbar: c(".note-toolbar"),
                editable: c(".note-editable"),
                codable: c(".note-codable"),
                statusbar: c(".note-statusbar"),
                popover: c(".note-popover"),
                handle: c(".note-handle"),
                dialog: c(".note-dialog")
            }
        }, k = function (a) {
            return a = a.toUpperCase(), function (b) {
                return b && b.nodeName.toUpperCase() === a
            }
        }, l = function (a) {
            return a && 3 === a.nodeType
        }, m = function (a) {
            return a && /^BR|^IMG|^HR/.test(a.nodeName.toUpperCase())
        }, n = function (a) {
            return b(a) ? !1 : a && /^DIV|^P|^LI|^H[1-7]/.test(a.nodeName.toUpperCase())
        }, o = k("LI"), p = function (a) {
            return n(a) && !o(a)
        }, q = k("TABLE"), r = function (a) {
            return !(v(a) || s(a) || n(a) || q(a) || u(a))
        }, s = function (a) {
            return a && /^UL|^OL/.test(a.nodeName.toUpperCase())
        }, t = function (a) {
            return a && /^TD|^TH/.test(a.nodeName.toUpperCase())
        }, u = k("BLOCKQUOTE"), v = function (a) {
            return t(a) || u(a) || b(a)
        }, w = k("A"), x = function (a) {
            return r(a) && !!G(a, n)
        }, y = function (a) {
            return r(a) && !G(a, n)
        }, z = k("BODY"), A = function (a, b) {
            return a.nextSibling === b || a.previousSibling === b
        }, B = function (a, b) {
            b = b || f.ok;
            var c = [];
            return a.previousSibling && b(a.previousSibling) && c.push(a.previousSibling), c.push(a), a.nextSibling && b(a.nextSibling) && c.push(a.nextSibling), c
        }, C = e.isMSIE ? "&nbsp;" : "<br>", D = function (a) {
            return l(a) ? a.nodeValue.length : a.childNodes.length
        }, E = function (a) {
            var b = D(a);
            return 0 === b ? !0 : j.isText(a) || 1 !== b || a.innerHTML !== C ? !1 : !0
        }, F = function (a) {
            m(a) || D(a) || (a.innerHTML = C)
        }, G = function (a, c) {
            for (; a;) {
                if (c(a))return a;
                if (b(a))break;
                a = a.parentNode
            }
            return null
        }, H = function (a, c) {
            for (a = a.parentNode; a && 1 === D(a);) {
                if (c(a))return a;
                if (b(a))break;
                a = a.parentNode
            }
            return null
        }, I = function (a, c) {
            c = c || f.fail;
            var d = [];
            return G(a, function (a) {
                return b(a) || d.push(a), c(a)
            }), d
        }, J = function (a, b) {
            var c = I(a);
            return g.last(c.filter(b))
        }, K = function (b, c) {
            for (var d = I(b), e = c; e; e = e.parentNode)if (a.inArray(e, d) > -1)return e;
            return null
        }, L = function (a, b) {
            b = b || f.fail;
            for (var c = []; a && !b(a);)c.push(a), a = a.previousSibling;
            return c
        }, M = function (a, b) {
            b = b || f.fail;
            for (var c = []; a && !b(a);)c.push(a), a = a.nextSibling;
            return c
        }, N = function (a, b) {
            var c = [];
            return b = b || f.ok, function d(e) {
                a !== e && b(e) && c.push(e);
                for (var f = 0, g = e.childNodes.length; g > f; f++)d(e.childNodes[f])
            }(a), c
        }, O = function (b, c) {
            var d = b.parentNode, e = a("<" + c + ">")[0];
            return d.insertBefore(e, b), e.appendChild(b), e
        }, P = function (a, b) {
            var c = b.nextSibling, d = b.parentNode;
            return c ? d.insertBefore(a, c) : d.appendChild(a), a
        }, Q = function (b, c) {
            return a.each(c, function (a, c) {
                b.appendChild(c)
            }), b
        }, R = function (a) {
            return 0 === a.offset
        }, S = function (a) {
            return a.offset === D(a.node)
        }, T = function (a) {
            return R(a) || S(a)
        }, U = function (a, b) {
            for (; a && a !== b;) {
                if (0 !== W(a))return !1;
                a = a.parentNode
            }
            return !0
        }, V = function (a, b) {
            for (; a && a !== b;) {
                if (W(a) !== D(a.parentNode) - 1)return !1;
                a = a.parentNode
            }
            return !0
        }, W = function (a) {
            for (var b = 0; a = a.previousSibling;)b += 1;
            return b
        }, X = function (a) {
            return !!(a && a.childNodes && a.childNodes.length)
        }, Y = function (a, c) {
            var d, e;
            if (0 === a.offset) {
                if (b(a.node))return null;
                d = a.node.parentNode, e = W(a.node)
            } else X(a.node) ? (d = a.node.childNodes[a.offset - 1], e = D(d)) : (d = a.node, e = c ? 0 : a.offset - 1);
            return {node: d, offset: e}
        }, Z = function (a, c) {
            var d, e;
            if (D(a.node) === a.offset) {
                if (b(a.node))return null;
                d = a.node.parentNode, e = W(a.node) + 1
            } else X(a.node) ? (d = a.node.childNodes[a.offset], e = 0) : (d = a.node, e = c ? D(a.node) : a.offset + 1);
            return {node: d, offset: e}
        }, $ = function (a, b) {
            return a.node === b.node && a.offset === b.offset
        }, _ = function (a) {
            if (l(a.node) || !X(a.node) || E(a.node))return !0;
            var b = a.node.childNodes[a.offset - 1], c = a.node.childNodes[a.offset];
            return b && !m(b) || c && !m(c) ? !1 : !0
        }, ab = function (a, b) {
            for (; a;) {
                if (b(a))return a;
                a = Y(a)
            }
            return null
        }, bb = function (a, b) {
            for (; a;) {
                if (b(a))return a;
                a = Z(a)
            }
            return null
        }, cb = function (a, b, c, d) {
            for (var e = a; e && (c(e), !$(e, b));) {
                var f = d && a.node !== e.node && b.node !== e.node;
                e = Z(e, f)
            }
        }, db = function (b, c) {
            var d = I(c, f.eq(b));
            return a.map(d, W).reverse()
        }, eb = function (a, b) {
            for (var c = a, d = 0, e = b.length; e > d; d++)c = c.childNodes.length <= b[d] ? c.childNodes[c.childNodes.length - 1] : c.childNodes[b[d]];
            return c
        }, fb = function (a, b) {
            if (l(a.node))return R(a) ? a.node : S(a) ? a.node.nextSibling : a.node.splitText(a.offset);
            var c = a.node.childNodes[a.offset], d = P(a.node.cloneNode(!1), a.node);
            return Q(d, M(c)), b || (F(a.node), F(d)), d
        }, gb = function (a, b, c) {
            var d = I(b.node, f.eq(a));
            return d.length ? 1 === d.length ? fb(b, c) : d.reduce(function (a, d) {
                var e = P(d.cloneNode(!1), d);
                return a === b.node && (a = fb(b, c)), Q(e, M(a)), c || (F(d), F(e)), e
            }) : null
        }, hb = function (a, b) {
            var c, d, e = b ? n : v, f = I(a.node, e), h = g.last(f) || a.node;
            e(h) ? (c = f[f.length - 2], d = h) : (c = h, d = c.parentNode);
            var i = c && gb(c, a, b);
            return {rightNode: i, container: d}
        }, ib = function (a) {
            return document.createElement(a)
        }, jb = function (a) {
            return document.createTextNode(a)
        }, kb = function (a, b) {
            if (a && a.parentNode) {
                if (a.removeNode)return a.removeNode(b);
                var c = a.parentNode;
                if (!b) {
                    var d, e, f = [];
                    for (d = 0, e = a.childNodes.length; e > d; d++)f.push(a.childNodes[d]);
                    for (d = 0, e = f.length; e > d; d++)c.insertBefore(f[d], a)
                }
                c.removeChild(a)
            }
        }, lb = function (a, c) {
            for (; a && !b(a) && c(a);) {
                var d = a.parentNode;
                kb(a), a = d
            }
        }, mb = function (a, b) {
            if (a.nodeName.toUpperCase() === b.toUpperCase())return a;
            var c = ib(b);
            return a.style.cssText && (c.style.cssText = a.style.cssText), Q(c, g.from(a.childNodes)), P(c, a), kb(a), c
        }, nb = k("TEXTAREA"), ob = function (b, c) {
            var d = nb(b[0]) ? b.val() : b.html();
            if (c) {
                var e = /<(\/?)(\b(?!!)[^>\s]*)(.*?)(\s*\/?>)/g;
                d = d.replace(e, function (a, b, c) {
                    c = c.toUpperCase();
                    var d = /^DIV|^TD|^TH|^P|^LI|^H[1-7]/.test(c) && !!b, e = /^BLOCKQUOTE|^TABLE|^TBODY|^TR|^HR|^UL|^OL/.test(c);
                    return a + (d || e ? "\n" : "")
                }), d = a.trim(d)
            }
            return d
        }, pb = function (a, b) {
            var c = a.val();
            return b ? c.replace(/[\n\r]/g, "") : c
        };
        return {
            NBSP_CHAR: h,
            ZERO_WIDTH_NBSP_CHAR: i,
            blank: C,
            emptyPara: "<p>" + C + "</p>",
            makePredByNodeName: k,
            isEditable: b,
            isControlSizing: c,
            buildLayoutInfo: d,
            isText: l,
            isVoid: m,
            isPara: n,
            isPurePara: p,
            isInline: r,
            isBodyInline: y,
            isBody: z,
            isParaInline: x,
            isList: s,
            isTable: q,
            isCell: t,
            isBlockquote: u,
            isBodyContainer: v,
            isAnchor: w,
            isDiv: k("DIV"),
            isLi: o,
            isBR: k("BR"),
            isSpan: k("SPAN"),
            isB: k("B"),
            isU: k("U"),
            isS: k("S"),
            isI: k("I"),
            isImg: k("IMG"),
            isTextarea: nb,
            isEmpty: E,
            isEmptyAnchor: f.and(w, E),
            isClosestSibling: A,
            withClosestSiblings: B,
            nodeLength: D,
            isLeftEdgePoint: R,
            isRightEdgePoint: S,
            isEdgePoint: T,
            isLeftEdgeOf: U,
            isRightEdgeOf: V,
            prevPoint: Y,
            nextPoint: Z,
            isSamePoint: $,
            isVisiblePoint: _,
            prevPointUntil: ab,
            nextPointUntil: bb,
            walkPoint: cb,
            ancestor: G,
            singleChildAncestor: H,
            listAncestor: I,
            lastAncestor: J,
            listNext: M,
            listPrev: L,
            listDescendant: N,
            commonAncestor: K,
            wrap: O,
            insertAfter: P,
            appendChildNodes: Q,
            position: W,
            hasChildren: X,
            makeOffsetPath: db,
            fromOffsetPath: eb,
            splitTree: gb,
            splitPoint: hb,
            create: ib,
            createText: jb,
            remove: kb,
            removeWhile: lb,
            replace: mb,
            html: ob,
            value: pb
        }
    }(), k = function () {
        var b = function (a, b) {
            var c, d, e = a.parentElement(), f = document.body.createTextRange(), h = g.from(e.childNodes);
            for (c = 0; c < h.length; c++)if (!j.isText(h[c])) {
                if (f.moveToElementText(h[c]), f.compareEndPoints("StartToStart", a) >= 0)break;
                d = h[c]
            }
            if (0 !== c && j.isText(h[c - 1])) {
                var i = document.body.createTextRange(), k = null;
                i.moveToElementText(d || e), i.collapse(!d), k = d ? d.nextSibling : e.firstChild;
                var l = a.duplicate();
                l.setEndPoint("StartToStart", i);
                for (var m = l.text.replace(/[\r\n]/g, "").length; m > k.nodeValue.length && k.nextSibling;)m -= k.nodeValue.length, k = k.nextSibling;
                {
                    k.nodeValue
                }
                b && k.nextSibling && j.isText(k.nextSibling) && m === k.nodeValue.length && (m -= k.nodeValue.length, k = k.nextSibling), e = k, c = m
            }
            return {cont: e, offset: c}
        }, c = function (a) {
            var b = function (a, c) {
                var d, e;
                if (j.isText(a)) {
                    var h = j.listPrev(a, f.not(j.isText)), i = g.last(h).previousSibling;
                    d = i || a.parentNode, c += g.sum(g.tail(h), j.nodeLength), e = !i
                } else {
                    if (d = a.childNodes[c] || a, j.isText(d))return b(d, 0);
                    c = 0, e = !1
                }
                return {node: d, collapseToStart: e, offset: c}
            }, c = document.body.createTextRange(), d = b(a.node, a.offset);
            return c.moveToElementText(d.node), c.collapse(d.collapseToStart), c.moveStart("character", d.offset), c
        }, d = function (b, h, i, k) {
            this.sc = b, this.so = h, this.ec = i, this.eo = k;
            var l = function () {
                if (e.isW3CRangeSupport) {
                    var a = document.createRange();
                    return a.setStart(b, h), a.setEnd(i, k), a
                }
                var d = c({node: b, offset: h});
                return d.setEndPoint("EndToEnd", c({node: i, offset: k})), d
            };
            this.getPoints = function () {
                return {sc: b, so: h, ec: i, eo: k}
            }, this.getStartPoint = function () {
                return {node: b, offset: h}
            }, this.getEndPoint = function () {
                return {node: i, offset: k}
            }, this.select = function () {
                var a = l();
                if (e.isW3CRangeSupport) {
                    var b = document.getSelection();
                    b.rangeCount > 0 && b.removeAllRanges(), b.addRange(a)
                } else a.select()
            }, this.normalize = function () {
                var a = function (a) {
                    return j.isVisiblePoint(a) || (a = j.isLeftEdgePoint(a) ? j.nextPointUntil(a, j.isVisiblePoint) : j.prevPointUntil(a, j.isVisiblePoint)), a
                }, b = a(this.getStartPoint()), c = a(this.getEndPoint());
                return new d(b.node, b.offset, c.node, c.offset)
            }, this.nodes = function (a, b) {
                a = a || f.ok;
                var c = b && b.includeAncestor, d = b && b.fullyContains, e = this.getStartPoint(), h = this.getEndPoint(), i = [], k = [];
                return j.walkPoint(e, h, function (b) {
                    if (!j.isEditable(b.node)) {
                        var e;
                        d ? (j.isLeftEdgePoint(b) && k.push(b.node), j.isRightEdgePoint(b) && g.contains(k, b.node) && (e = b.node)) : e = c ? j.ancestor(b.node, a) : b.node, e && a(e) && i.push(e)
                    }
                }, !0), g.unique(i)
            }, this.commonAncestor = function () {
                return j.commonAncestor(b, i)
            }, this.expand = function (a) {
                var c = j.ancestor(b, a), e = j.ancestor(i, a);
                if (!c && !e)return new d(b, h, i, k);
                var f = this.getPoints();
                return c && (f.sc = c, f.so = 0), e && (f.ec = e, f.eo = j.nodeLength(e)), new d(f.sc, f.so, f.ec, f.eo)
            }, this.collapse = function (a) {
                return a ? new d(b, h, b, h) : new d(i, k, i, k)
            }, this.splitText = function () {
                var a = b === i, c = this.getPoints();
                return j.isText(i) && !j.isEdgePoint(this.getEndPoint()) && i.splitText(k), j.isText(b) && !j.isEdgePoint(this.getStartPoint()) && (c.sc = b.splitText(h), c.so = 0, a && (c.ec = c.sc, c.eo = k - h)), new d(c.sc, c.so, c.ec, c.eo)
            }, this.deleteContents = function () {
                if (this.isCollapsed())return this;
                var b = this.splitText(), c = b.nodes(null, {fullyContains: !0}), e = j.prevPointUntil(b.getStartPoint(), function (a) {
                    return !g.contains(c, a.node)
                }), f = [];
                return a.each(c, function (a, b) {
                    var c = b.parentNode;
                    e.node !== c && 1 === j.nodeLength(c) && f.push(c), j.remove(b, !1)
                }), a.each(f, function (a, b) {
                    j.remove(b, !1)
                }), new d(e.node, e.offset, e.node, e.offset).normalize()
            };
            var m = function (a) {
                return function () {
                    var c = j.ancestor(b, a);
                    return !!c && c === j.ancestor(i, a)
                }
            };
            this.isOnEditable = m(j.isEditable), this.isOnList = m(j.isList), this.isOnAnchor = m(j.isAnchor), this.isOnCell = m(j.isCell), this.isLeftEdgeOf = function (a) {
                if (!j.isLeftEdgePoint(this.getStartPoint()))return !1;
                var b = j.ancestor(this.sc, a);
                return b && j.isLeftEdgeOf(this.sc, b)
            }, this.isCollapsed = function () {
                return b === i && h === k
            }, this.wrapBodyInlineWithPara = function () {
                if (j.isBodyContainer(b) && j.isEmpty(b))return b.innerHTML = j.emptyPara, new d(b.firstChild, 0, b.firstChild, 0);
                if (j.isParaInline(b) || j.isPara(b))return this.normalize();
                var a;
                if (j.isInline(b)) {
                    var c = j.listAncestor(b, f.not(j.isInline));
                    a = g.last(c), j.isInline(a) || (a = c[c.length - 2] || b.childNodes[h])
                } else a = b.childNodes[h > 0 ? h - 1 : 0];
                var e = j.listPrev(a, j.isParaInline).reverse();
                if (e = e.concat(j.listNext(a.nextSibling, j.isParaInline)), e.length) {
                    var i = j.wrap(g.head(e), "p");
                    j.appendChildNodes(i, g.tail(e))
                }
                return this.normalize()
            }, this.insertNode = function (a) {
                var b = this.wrapBodyInlineWithPara().deleteContents(), c = j.splitPoint(b.getStartPoint(), j.isInline(a));
                return c.rightNode ? c.rightNode.parentNode.insertBefore(a, c.rightNode) : c.container.appendChild(a), a
            }, this.toString = function () {
                var a = l();
                return e.isW3CRangeSupport ? a.toString() : a.text
            }, this.bookmark = function (a) {
                return {s: {path: j.makeOffsetPath(a, b), offset: h}, e: {path: j.makeOffsetPath(a, i), offset: k}}
            }, this.paraBookmark = function (a) {
                return {
                    s: {path: g.tail(j.makeOffsetPath(g.head(a), b)), offset: h},
                    e: {path: g.tail(j.makeOffsetPath(g.last(a), i)), offset: k}
                }
            }, this.getClientRects = function () {
                var a = l();
                return a.getClientRects()
            }
        };
        return {
            create: function (a, c, f, g) {
                if (arguments.length)2 === arguments.length && (f = a, g = c); else if (e.isW3CRangeSupport) {
                    var h = document.getSelection();
                    if (0 === h.rangeCount)return null;
                    if (j.isBody(h.anchorNode))return null;
                    var i = h.getRangeAt(0);
                    a = i.startContainer, c = i.startOffset, f = i.endContainer, g = i.endOffset
                } else {
                    var k = document.selection.createRange(), l = k.duplicate();
                    l.collapse(!1);
                    var m = k;
                    m.collapse(!0);
                    var n = b(m, !0), o = b(l, !1);
                    j.isText(n.node) && j.isLeftEdgePoint(n) && j.isTextNode(o.node) && j.isRightEdgePoint(o) && o.node.nextSibling === n.node && (n = o), a = n.cont, c = n.offset, f = o.cont, g = o.offset
                }
                return new d(a, c, f, g)
            }, createFromNode: function (a) {
                var b = a, c = 0, d = a, e = j.nodeLength(d);
                return j.isVoid(b) && (c = j.listPrev(b).length - 1, b = b.parentNode), j.isBR(d) ? (e = j.listPrev(d).length - 1, d = d.parentNode) : j.isVoid(d) && (e = j.listPrev(d).length, d = d.parentNode), this.create(b, c, d, e)
            }, createFromBookmark: function (a, b) {
                var c = j.fromOffsetPath(a, b.s.path), e = b.s.offset, f = j.fromOffsetPath(a, b.e.path), g = b.e.offset;
                return new d(c, e, f, g)
            }, createFromParaBookmark: function (a, b) {
                var c = a.s.offset, e = a.e.offset, f = j.fromOffsetPath(g.head(b), a.s.path), h = j.fromOffsetPath(g.last(b), a.e.path);
                return new d(f, c, h, e)
            }
        }
    }(), l = {
        version: "0.6.1",
        options: {
            width: null,
            height: null,
            minHeight: null,
            maxHeight: null,
            focus: !1,
            tabsize: 4,
            styleWithSpan: !0,
            disableLinkTarget: !1,
            disableDragAndDrop: !1,
            disableResizeEditor: !1,
            shortcuts: !0,
            placeholder: !1,
            prettifyHtml: !0,
            codemirror: {mode: "text/html", htmlMode: !0, lineNumbers: !0},
            lang: "en-US",
            direction: null,
            toolbar: [["style", ["style"]], ["font", ["bold", "italic", "underline", "clear"]], ["fontname", ["fontname"]], ["color", ["color"]], ["para", ["ul", "ol", "paragraph"]], ["height", ["height"]], ["table", ["table"]], ["insert", ["link", "picture", "hr"]], ["view", ["fullscreen", "codeview"]], ["help", ["help"]]],
            airMode: !1,
            airPopover: [["color", ["color"]], ["font", ["bold", "underline", "clear"]], ["para", ["ul", "paragraph"]], ["table", ["table"]], ["insert", ["link", "picture"]]],
            styleTags: ["p", "blockquote", "pre", "h1", "h2", "h3", "h4", "h5", "h6"],
            defaultFontName: "Helvetica Neue",
            fontNames: ["Arial", "Arial Black", "Comic Sans MS", "Courier New", "Helvetica Neue", "Impact", "Lucida Grande", "Tahoma", "Times New Roman", "Verdana"],
            fontNamesIgnoreCheck: [],
            colors: [["#000000", "#424242", "#636363", "#9C9C94", "#CEC6CE", "#EFEFEF", "#F7F7F7", "#FFFFFF"], ["#FF0000", "#FF9C00", "#FFFF00", "#00FF00", "#00FFFF", "#0000FF", "#9C00FF", "#FF00FF"], ["#F7C6CE", "#FFE7CE", "#FFEFC6", "#D6EFD6", "#CEDEE7", "#CEE7F7", "#D6D6E7", "#E7D6DE"], ["#E79C9C", "#FFC69C", "#FFE79C", "#B5D6A5", "#A5C6CE", "#9CC6EF", "#B5A5D6", "#D6A5BD"], ["#E76363", "#F7AD6B", "#FFD663", "#94BD7B", "#73A5AD", "#6BADDE", "#8C7BC6", "#C67BA5"], ["#CE0000", "#E79439", "#EFC631", "#6BA54A", "#4A7B8C", "#3984C6", "#634AA5", "#A54A7B"], ["#9C0000", "#B56308", "#BD9400", "#397B21", "#104A5A", "#085294", "#311873", "#731842"], ["#630000", "#7B3900", "#846300", "#295218", "#083139", "#003163", "#21104A", "#4A1031"]],
            lineHeights: ["1.0", "1.2", "1.4", "1.5", "1.6", "1.8", "2.0", "3.0"],
            insertTableMaxSize: {col: 10, row: 10},
            maximumImageFileSize: null,
            oninit: null,
            onfocus: null,
            onblur: null,
            onenter: null,
            onkeyup: null,
            onkeydown: null,
            onImageUpload: null,
            onImageUploadError: null,
            onMediaDelete: null,
            onToolbarClick: null,
            onsubmit: null,
            onCreateLink: function (a) {
                return -1 !== a.indexOf("@") && -1 === a.indexOf(":") ? a = "mailto:" + a : -1 === a.indexOf("://") && (a = "http://" + a), a
            },
            keyMap: {
                pc: {
                    ENTER: "insertParagraph",
                    "CTRL+Z": "undo",
                    "CTRL+Y": "redo",
                    TAB: "tab",
                    "SHIFT+TAB": "untab",
                    "CTRL+B": "bold",
                    "CTRL+I": "italic",
                    "CTRL+U": "underline",
                    "CTRL+SHIFT+S": "strikethrough",
                    "CTRL+BACKSLASH": "removeFormat",
                    "CTRL+SHIFT+L": "justifyLeft",
                    "CTRL+SHIFT+E": "justifyCenter",
                    "CTRL+SHIFT+R": "justifyRight",
                    "CTRL+SHIFT+J": "justifyFull",
                    "CTRL+SHIFT+NUM7": "insertUnorderedList",
                    "CTRL+SHIFT+NUM8": "insertOrderedList",
                    "CTRL+LEFTBRACKET": "outdent",
                    "CTRL+RIGHTBRACKET": "indent",
                    "CTRL+NUM0": "formatPara",
                    "CTRL+NUM1": "formatH1",
                    "CTRL+NUM2": "formatH2",
                    "CTRL+NUM3": "formatH3",
                    "CTRL+NUM4": "formatH4",
                    "CTRL+NUM5": "formatH5",
                    "CTRL+NUM6": "formatH6",
                    "CTRL+ENTER": "insertHorizontalRule",
                    "CTRL+K": "showLinkDialog"
                },
                mac: {
                    ENTER: "insertParagraph",
                    "CMD+Z": "undo",
                    "CMD+SHIFT+Z": "redo",
                    TAB: "tab",
                    "SHIFT+TAB": "untab",
                    "CMD+B": "bold",
                    "CMD+I": "italic",
                    "CMD+U": "underline",
                    "CMD+SHIFT+S": "strikethrough",
                    "CMD+BACKSLASH": "removeFormat",
                    "CMD+SHIFT+L": "justifyLeft",
                    "CMD+SHIFT+E": "justifyCenter",
                    "CMD+SHIFT+R": "justifyRight",
                    "CMD+SHIFT+J": "justifyFull",
                    "CMD+SHIFT+NUM7": "insertUnorderedList",
                    "CMD+SHIFT+NUM8": "insertOrderedList",
                    "CMD+LEFTBRACKET": "outdent",
                    "CMD+RIGHTBRACKET": "indent",
                    "CMD+NUM0": "formatPara",
                    "CMD+NUM1": "formatH1",
                    "CMD+NUM2": "formatH2",
                    "CMD+NUM3": "formatH3",
                    "CMD+NUM4": "formatH4",
                    "CMD+NUM5": "formatH5",
                    "CMD+NUM6": "formatH6",
                    "CMD+ENTER": "insertHorizontalRule",
                    "CMD+K": "showLinkDialog"
                }
            }
        },
        lang: {
            "en-US": {
                font: {
                    bold: "Bold",
                    italic: "Italic",
                    underline: "Underline",
                    clear: "Remove Font Style",
                    height: "Line Height",
                    name: "Font Family"
                },
                image: {
                    image: "Picture",
                    insert: "Insert Image",
                    resizeFull: "Resize Full",
                    resizeHalf: "Resize Half",
                    resizeQuarter: "Resize Quarter",
                    floatLeft: "Float Left",
                    floatRight: "Float Right",
                    floatNone: "Float None",
                    shapeRounded: "Shape: Rounded",
                    shapeCircle: "Shape: Circle",
                    shapeThumbnail: "Shape: Thumbnail",
                    shapeNone: "Shape: None",
                    dragImageHere: "Drag image or text here",
                    dropImage: "Drop image or Text",
                    selectFromFiles: "Select from files",
                    maximumFileSize: "Maximum file size",
                    maximumFileSizeError: "Maximum file size exceeded.",
                    url: "Image URL",
                    remove: "Remove Image"
                },
                link: {
                    link: "Link",
                    insert: "Insert Link",
                    unlink: "Unlink",
                    edit: "Edit",
                    textToDisplay: "Text to display",
                    url: "To what URL should this link go?",
                    openInNewWindow: "Open in new window"
                },
                table: {table: "Table"},
                hr: {insert: "Insert Horizontal Rule"},
                style: {
                    style: "Style",
                    normal: "Normal",
                    blockquote: "Quote",
                    pre: "Code",
                    h1: "Header 1",
                    h2: "Header 2",
                    h3: "Header 3",
                    h4: "Header 4",
                    h5: "Header 5",
                    h6: "Header 6"
                },
                lists: {unordered: "Unordered list", ordered: "Ordered list"},
                options: {help: "Help", fullscreen: "Full Screen", codeview: "Code View"},
                paragraph: {
                    paragraph: "Paragraph",
                    outdent: "Outdent",
                    indent: "Indent",
                    left: "Align left",
                    center: "Align center",
                    right: "Align right",
                    justify: "Justify full"
                },
                color: {
                    recent: "Recent Color",
                    more: "More Color",
                    background: "Background Color",
                    foreground: "Foreground Color",
                    transparent: "Transparent",
                    setTransparent: "Set transparent",
                    reset: "Reset",
                    resetToDefault: "Reset to default"
                },
                shortcut: {
                    shortcuts: "Keyboard shortcuts",
                    close: "Close",
                    textFormatting: "Text formatting",
                    action: "Action",
                    paragraphFormatting: "Paragraph formatting",
                    documentStyle: "Document Style",
                    extraKeys: "Extra keys"
                },
                history: {undo: "Undo", redo: "Redo"}
            }
        }
    }, m = function () {
        var b = function (b) {
            return a.Deferred(function (c) {
                a.extend(new FileReader, {
                    onload: function (a) {
                        var b = a.target.result;
                        c.resolve(b)
                    }, onerror: function () {
                        c.reject(this)
                    }
                }).readAsDataURL(b)
            }).promise()
        }, c = function (b, c) {
            return a.Deferred(function (d) {
                var e = a("<img>");
                e.one("load", function () {
                    e.off("error abort"), d.resolve(e)
                }).one("error abort", function () {
                    e.off("load").detach(), d.reject(e)
                }).css({display: "none"}).appendTo(document.body).attr({src: b, "data-filename": c})
            }).promise()
        };
        return {readFileAsDataURL: b, createImage: c}
    }(), n = {
        isEdit: function (a) {
            return g.contains([8, 9, 13, 32], a)
        },
        nameFromCode: {
            8: "BACKSPACE",
            9: "TAB",
            13: "ENTER",
            32: "SPACE",
            48: "NUM0",
            49: "NUM1",
            50: "NUM2",
            51: "NUM3",
            52: "NUM4",
            53: "NUM5",
            54: "NUM6",
            55: "NUM7",
            56: "NUM8",
            66: "B",
            69: "E",
            73: "I",
            74: "J",
            75: "K",
            76: "L",
            82: "R",
            83: "S",
            85: "U",
            89: "Y",
            90: "Z",
            191: "SLASH",
            219: "LEFTBRACKET",
            220: "BACKSLASH",
            221: "RIGHTBRACKET"
        }
    }, o = function () {
        var b = function (b, c) {
            if (e.jqueryVersion < 1.9) {
                var d = {};
                return a.each(c, function (a, c) {
                    d[c] = b.css(c)
                }), d
            }
            return b.css.call(b, c)
        };
        this.stylePara = function (b, c) {
            a.each(b.nodes(j.isPara, {includeAncestor: !0}), function (b, d) {
                a(d).css(c)
            })
        }, this.styleNodes = function (b, c) {
            b = b.splitText();
            var d = c && c.nodeName || "SPAN", e = !(!c || !c.expandClosestSibling), h = !(!c || !c.onlyPartialContains);
            if (b.isCollapsed())return b.insertNode(j.create(d));
            var i = j.makePredByNodeName(d), k = a.map(b.nodes(j.isText, {fullyContains: !0}), function (a) {
                return j.singleChildAncestor(a, i) || j.wrap(a, d)
            });
            if (e) {
                if (h) {
                    var l = b.nodes();
                    i = f.and(i, function (a) {
                        return g.contains(l, a)
                    })
                }
                return a.map(k, function (b) {
                    var c = j.withClosestSiblings(b, i), d = g.head(c), e = g.tail(c);
                    return a.each(e, function (a, b) {
                        j.appendChildNodes(d, b.childNodes), j.remove(b)
                    }), g.head(c)
                })
            }
            return k
        }, this.current = function (c, d) {
            var e = a(j.isText(c.sc) ? c.sc.parentNode : c.sc), f = ["font-family", "font-size", "text-align", "list-style-type", "line-height"], g = b(e, f) || {};
            if (g["font-size"] = parseInt(g["font-size"], 10), g["font-bold"] = document.queryCommandState("bold") ? "bold" : "normal", g["font-italic"] = document.queryCommandState("italic") ? "italic" : "normal", g["font-underline"] = document.queryCommandState("underline") ? "underline" : "normal", g["font-strikethrough"] = document.queryCommandState("strikeThrough") ? "strikethrough" : "normal", g["font-superscript"] = document.queryCommandState("superscript") ? "superscript" : "normal", g["font-subscript"] = document.queryCommandState("subscript") ? "subscript" : "normal", c.isOnList()) {
                var h = ["circle", "disc", "disc-leading-zero", "square"], i = a.inArray(g["list-style-type"], h) > -1;
                g["list-style"] = i ? "unordered" : "ordered"
            } else g["list-style"] = "none";
            var k = j.ancestor(c.sc, j.isPara);
            if (k && k.style["line-height"])g["line-height"] = k.style.lineHeight; else {
                var l = parseInt(g["line-height"], 10) / parseInt(g["font-size"], 10);
                g["line-height"] = l.toFixed(1)
            }
            return g.image = j.isImg(d) && d, g.anchor = c.isOnAnchor() && j.ancestor(c.sc, j.isAnchor), g.ancestors = j.listAncestor(c.sc, j.isEditable), g.range = c, g
        }
    }, p = function () {
        this.insertTab = function (a, b, c) {
            var d = j.createText(new Array(c + 1).join(j.NBSP_CHAR));
            b = b.deleteContents(), b.insertNode(d, !0), b = k.create(d, c), b.select()
        }, this.insertParagraph = function () {
            var b = k.create();
            b = b.deleteContents(), b = b.wrapBodyInlineWithPara();
            var c, d = j.ancestor(b.sc, j.isPara);
            if (d) {
                c = j.splitTree(d, b.getStartPoint());
                var e = j.listDescendant(d, j.isEmptyAnchor);
                e = e.concat(j.listDescendant(c, j.isEmptyAnchor)), a.each(e, function (a, b) {
                    j.remove(b)
                })
            } else {
                var f = b.sc.childNodes[b.so];
                c = a(j.emptyPara)[0], f ? b.sc.insertBefore(c, f) : b.sc.appendChild(c)
            }
            k.create(c, 0).normalize().select()
        }
    }, q = function () {
        this.tab = function (a, b) {
            var c = j.ancestor(a.commonAncestor(), j.isCell), d = j.ancestor(c, j.isTable), e = j.listDescendant(d, j.isCell), f = g[b ? "prev" : "next"](e, c);
            f && k.create(f, 0).select()
        }, this.createTable = function (b, c) {
            for (var d, e = [], f = 0; b > f; f++)e.push("<td>" + j.blank + "</td>");
            d = e.join("");
            for (var g, h = [], i = 0; c > i; i++)h.push("<tr>" + d + "</tr>");
            return g = h.join(""), a('<table class="table table-bordered">' + g + "</table>")[0]
        }
    }, r = function () {
        this.insertOrderedList = function () {
            this.toggleList("OL")
        }, this.insertUnorderedList = function () {
            this.toggleList("UL")
        }, this.indent = function () {
            var b = this, c = k.create().wrapBodyInlineWithPara(), d = c.nodes(j.isPara, {includeAncestor: !0}), e = g.clusterBy(d, f.peq2("parentNode"));
            a.each(e, function (c, d) {
                var e = g.head(d);
                j.isLi(e) ? b.wrapList(d, e.parentNode.nodeName) : a.each(d, function (b, c) {
                    a(c).css("marginLeft", function (a, b) {
                        return (parseInt(b, 10) || 0) + 25
                    })
                })
            }), c.select()
        }, this.outdent = function () {
            var b = this, c = k.create().wrapBodyInlineWithPara(), d = c.nodes(j.isPara, {includeAncestor: !0}), e = g.clusterBy(d, f.peq2("parentNode"));
            a.each(e, function (c, d) {
                var e = g.head(d);
                j.isLi(e) ? b.releaseList([d]) : a.each(d, function (b, c) {
                    a(c).css("marginLeft", function (a, b) {
                        return b = parseInt(b, 10) || 0, b > 25 ? b - 25 : ""
                    })
                })
            }), c.select()
        }, this.toggleList = function (b) {
            var c = this, d = k.create().wrapBodyInlineWithPara(), e = d.nodes(j.isPara, {includeAncestor: !0}), h = d.paraBookmark(e), i = g.clusterBy(e, f.peq2("parentNode"));
            if (g.find(e, j.isPurePara)) {
                var l = [];
                a.each(i, function (a, d) {
                    l = l.concat(c.wrapList(d, b))
                }), e = l
            } else {
                var m = d.nodes(j.isList, {includeAncestor: !0}).filter(function (c) {
                    return !a.nodeName(c, b)
                });
                m.length ? a.each(m, function (a, c) {
                    j.replace(c, b)
                }) : e = this.releaseList(i, !0)
            }
            k.createFromParaBookmark(h, e).select()
        }, this.wrapList = function (b, c) {
            var d = g.head(b), e = g.last(b), f = j.isList(d.previousSibling) && d.previousSibling, h = j.isList(e.nextSibling) && e.nextSibling, i = f || j.insertAfter(j.create(c || "UL"), e);
            return b = a.map(b, function (a) {
                return j.isPurePara(a) ? j.replace(a, "LI") : a
            }), j.appendChildNodes(i, b), h && (j.appendChildNodes(i, g.from(h.childNodes)), j.remove(h)), b
        }, this.releaseList = function (b, c) {
            var d = [];
            return a.each(b, function (b, e) {
                var f = g.head(e), h = g.last(e), i = c ? j.lastAncestor(f, j.isList) : f.parentNode, k = i.childNodes.length > 1 ? j.splitTree(i, {
                    node: h.parentNode,
                    offset: j.position(h) + 1
                }, !0) : null, l = j.splitTree(i, {node: f.parentNode, offset: j.position(f)}, !0);
                e = c ? j.listDescendant(l, j.isLi) : g.from(l.childNodes).filter(j.isLi), (c || !j.isList(i.parentNode)) && (e = a.map(e, function (a) {
                    return j.replace(a, "P")
                })), a.each(g.from(e).reverse(), function (a, b) {
                    j.insertAfter(b, i)
                });
                var m = g.compact([i, l, k]);
                a.each(m, function (b, c) {
                    var d = [c].concat(j.listDescendant(c, j.isList));
                    a.each(d.reverse(), function (a, b) {
                        j.nodeLength(b) || j.remove(b, !0)
                    })
                }), d = d.concat(e)
            }), d
        }
    }, s = function () {
        var b = new o, c = new q, d = new p, f = new r;
        this.createRange = function (a) {
            return a.focus(), k.create()
        }, this.saveRange = function (a, b) {
            a.focus(), a.data("range", k.create()), b && k.create().collapse().select()
        }, this.saveNode = function (a) {
            for (var b = [], c = 0, d = a[0].childNodes.length; d > c; c++)b.push(a[0].childNodes[c]);
            a.data("childNodes", b)
        }, this.restoreRange = function (a) {
            var b = a.data("range");
            b && (b.select(), a.focus())
        }, this.restoreNode = function (a) {
            a.html("");
            for (var b = a.data("childNodes"), c = 0, d = b.length; d > c; c++)a[0].appendChild(b[c])
        }, this.currentStyle = function (a) {
            var c = k.create();
            return c ? c.isOnEditable() && b.current(c, a) : !1
        };
        var h = this.triggerOnBeforeChange = function (a) {
            var b = a.data("callbacks").onBeforeChange;
            b && b(a.html(), a)
        }, i = this.triggerOnChange = function (a) {
            var b = a.data("callbacks").onChange;
            b && b(a.html(), a)
        };
        this.undo = function (a) {
            h(a), a.data("NoteHistory").undo(), i(a)
        }, this.redo = function (a) {
            h(a), a.data("NoteHistory").redo(), i(a)
        };
        for (var l = this.beforeCommand = function (a) {
            h(a)
        }, n = this.afterCommand = function (a) {
            a.data("NoteHistory").recordUndo(), i(a)
        }, s = ["bold", "italic", "underline", "strikethrough", "superscript", "subscript", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull", "formatBlock", "removeFormat", "backColor", "foreColor", "insertHorizontalRule", "fontName"], t = 0, u = s.length; u > t; t++)this[s[t]] = function (a) {
            return function (b, c) {
                l(b), document.execCommand(a, !1, c), n(b)
            }
        }(s[t]);
        this.tab = function (a, b) {
            var e = k.create();
            e.isCollapsed() && e.isOnCell() ? c.tab(e) : (l(a), d.insertTab(a, e, b.tabsize), n(a))
        }, this.untab = function () {
            var a = k.create();
            a.isCollapsed() && a.isOnCell() && c.tab(a, !0)
        }, this.insertParagraph = function (a) {
            l(a), d.insertParagraph(a), n(a)
        }, this.insertOrderedList = function (a) {
            l(a), f.insertOrderedList(a), n(a)
        }, this.insertUnorderedList = function (a) {
            l(a), f.insertUnorderedList(a), n(a)
        }, this.indent = function (a) {
            l(a), f.indent(a), n(a)
        }, this.outdent = function (a) {
            l(a), f.outdent(a), n(a)
        }, this.insertImage = function (a, b, c) {
            m.createImage(b, c).then(function (b) {
                l(a), b.css({
                    display: "",
                    width: Math.min(a.width(), b.width())
                }), k.create().insertNode(b[0]), k.createFromNode(b[0]).collapse().select(), n(a)
            }).fail(function () {
                var b = a.data("callbacks");
                b.onImageUploadError && b.onImageUploadError()
            })
        }, this.insertNode = function (a, b) {
            l(a);
            var c = this.createRange(a);
            c.insertNode(b), k.createFromNode(b).collapse().select(), n(a)
        }, this.insertText = function (a, b) {
            l(a);
            var c = this.createRange(a), d = c.insertNode(j.createText(b));
            k.create(d, j.nodeLength(d)).select(), n(a)
        }, this.formatBlock = function (a, b) {
            l(a), b = e.isMSIE ? "<" + b + ">" : b, document.execCommand("FormatBlock", !1, b), n(a)
        }, this.formatPara = function (a) {
            l(a), this.formatBlock(a, "P"), n(a)
        };
        for (var t = 1; 6 >= t; t++)this["formatH" + t] = function (a) {
            return function (b) {
                this.formatBlock(b, "H" + a)
            }
        }(t);
        this.fontSize = function (a, b) {
            l(a), document.execCommand("fontSize", !1, 3), e.isFF ? a.find("font[size=3]").removeAttr("size").css("font-size", b + "px") : a.find("span").filter(function () {
                return "medium" === this.style.fontSize
            }).css("font-size", b + "px"), n(a)
        }, this.lineHeight = function (a, c) {
            l(a), b.stylePara(k.create(), {lineHeight: c}), n(a)
        }, this.unlink = function (a) {
            var b = k.create();
            if (b.isOnAnchor()) {
                var c = j.ancestor(b.sc, j.isAnchor);
                b = k.createFromNode(c), b.select(), l(a), document.execCommand("unlink"), n(a)
            }
        }, this.createLink = function (c, d, e) {
            var f = d.url, h = d.text, i = d.newWindow, j = d.range, m = j.toString() !== h;
            l(c), e.onCreateLink && (f = e.onCreateLink(f));
            var o;
            if (m) {
                var p = j.insertNode(a("<A>" + h + "</A>")[0]);
                o = [p]
            } else o = b.styleNodes(j, {nodeName: "A", expandClosestSibling: !0, onlyPartialContains: !0});
            a.each(o, function (b, c) {
                a(c).attr({href: f, target: i ? "_blank" : ""})
            });
            var q = k.createFromNode(g.head(o)).collapse(!0), r = q.getStartPoint(), s = k.createFromNode(g.last(o)).collapse(), t = s.getEndPoint();
            k.create(r.node, r.offset, t.node, t.offset).select(), n(c)
        }, this.getLinkInfo = function (b) {
            b.focus();
            var c = k.create().expand(j.isAnchor), d = a(g.head(c.nodes(j.isAnchor)));
            return {
                range: c,
                text: c.toString(),
                isNewWindow: d.length ? "_blank" === d.attr("target") : !0,
                url: d.length ? d.attr("href") : ""
            }
        }, this.color = function (a, b) {
            var c = JSON.parse(b), d = c.foreColor, e = c.backColor;
            l(a), d && document.execCommand("foreColor", !1, d), e && document.execCommand("backColor", !1, e), n(a)
        }, this.insertTable = function (a, b) {
            var d = b.split("x");
            l(a);
            var e = k.create();
            e = e.deleteContents(), e.insertNode(c.createTable(d[0], d[1])), n(a)
        }, this.floatMe = function (a, b, c) {
            l(a), c.css("float", b), n(a)
        }, this.imageShape = function (a, b, c) {
            l(a), c.removeClass("img-rounded img-circle img-thumbnail"), b && c.addClass(b), n(a)
        }, this.resize = function (a, b, c) {
            l(a), c.css({width: 100 * b + "%", height: ""}), n(a)
        }, this.resizeTo = function (a, b, c) {
            var d;
            if (c) {
                var e = a.y / a.x, f = b.data("ratio");
                d = {width: f > e ? a.x : a.y / f, height: f > e ? a.x * f : a.y}
            } else d = {width: a.x, height: a.y};
            b.css(d)
        }, this.removeMedia = function (a, b, c) {
            l(a), c.detach();
            var d = a.data("callbacks");
            d && d.onMediaDelete && d.onMediaDelete(c, this, a), n(a)
        }
    }, t = function (a) {
        var b = [], c = -1, d = a[0], e = function () {
            var b = k.create(), c = {s: {path: [0], offset: 0}, e: {path: [0], offset: 0}};
            return {contents: a.html(), bookmark: b ? b.bookmark(d) : c}
        }, f = function (b) {
            null !== b.contents && a.html(b.contents), null !== b.bookmark && k.createFromBookmark(d, b.bookmark).select()
        };
        this.undo = function () {
            c > 0 && (c--, f(b[c]))
        }, this.redo = function () {
            b.length - 1 > c && (c++, f(b[c]))
        }, this.recordUndo = function () {
            c++, b.length > c && (b = b.slice(0, c)), b.push(e())
        }, this.recordUndo()
    }, u = function () {
        this.update = function (b, c) {
            var d = function (b, c) {
                b.find(".dropdown-menu li a").each(function () {
                    var b = a(this).data("value") + "" == c + "";
                    this.className = b ? "checked" : ""
                })
            }, e = function (a, c) {
                var d = b.find(a);
                d.toggleClass("active", c())
            };
            if (c.image) {
                var f = a(c.image);
                e('button[data-event="imageShape"][data-value="img-rounded"]', function () {
                    return f.hasClass("img-rounded")
                }), e('button[data-event="imageShape"][data-value="img-circle"]', function () {
                    return f.hasClass("img-circle")
                }), e('button[data-event="imageShape"][data-value="img-thumbnail"]', function () {
                    return f.hasClass("img-thumbnail")
                }), e('button[data-event="imageShape"]:not([data-value])', function () {
                    return !f.is(".img-rounded, .img-circle, .img-thumbnail")
                });
                var h = f.css("float");
                e('button[data-event="floatMe"][data-value="left"]', function () {
                    return "left" === h
                }), e('button[data-event="floatMe"][data-value="right"]', function () {
                    return "right" === h
                }), e('button[data-event="floatMe"][data-value="none"]', function () {
                    return "left" !== h && "right" !== h
                });
                var i = f.attr("style");
                return e('button[data-event="resize"][data-value="1"]', function () {
                    return !!/(^|\s)(max-)?width\s*:\s*100%/.test(i)
                }), e('button[data-event="resize"][data-value="0.5"]', function () {
                    return !!/(^|\s)(max-)?width\s*:\s*50%/.test(i)
                }), void e('button[data-event="resize"][data-value="0.25"]', function () {
                    return !!/(^|\s)(max-)?width\s*:\s*25%/.test(i)
                })
            }
            var j = b.find(".note-fontname");
            if (j.length) {
                var k = c["font-family"];
                k && (k = g.head(k.split(",")), k = k.replace(/\'/g, ""), j.find(".note-current-fontname").text(k), d(j, k))
            }
            var l = b.find(".note-fontsize");
            l.find(".note-current-fontsize").text(c["font-size"]), d(l, parseFloat(c["font-size"]));
            var m = b.find(".note-height");
            d(m, parseFloat(c["line-height"])), e('button[data-event="bold"]', function () {
                return "bold" === c["font-bold"]
            }), e('button[data-event="italic"]', function () {
                return "italic" === c["font-italic"]
            }), e('button[data-event="underline"]', function () {
                return "underline" === c["font-underline"]
            }), e('button[data-event="strikethrough"]', function () {
                return "strikethrough" === c["font-strikethrough"]
            }), e('button[data-event="superscript"]', function () {
                return "superscript" === c["font-superscript"]
            }), e('button[data-event="subscript"]', function () {
                return "subscript" === c["font-subscript"]
            }), e('button[data-event="justifyLeft"]', function () {
                return "left" === c["text-align"] || "start" === c["text-align"]
            }), e('button[data-event="justifyCenter"]', function () {
                return "center" === c["text-align"]
            }), e('button[data-event="justifyRight"]', function () {
                return "right" === c["text-align"]
            }), e('button[data-event="justifyFull"]', function () {
                return "justify" === c["text-align"]
            }), e('button[data-event="insertUnorderedList"]', function () {
                return "unordered" === c["list-style"]
            }), e('button[data-event="insertOrderedList"]', function () {
                return "ordered" === c["list-style"]
            })
        }, this.updateRecentColor = function (b, c, d) {
            var e = a(b).closest(".note-color"), f = e.find(".note-recent-color"), g = JSON.parse(f.attr("data-value"));
            g[c] = d, f.attr("data-value", JSON.stringify(g));
            var h = "backColor" === c ? "background-color" : "color";
            f.find("i").css(h, d)
        }
    }, v = function () {
        var a = new u;
        this.update = function (b, c) {
            a.update(b, c)
        }, this.updateRecentColor = function (b, c, d) {
            a.updateRecentColor(b, c, d)
        }, this.activate = function (a) {
            a.find("button").not('button[data-event="codeview"]').removeClass("disabled")
        }, this.deactivate = function (a) {
            a.find("button").not('button[data-event="codeview"]').addClass("disabled")
        }, this.updateFullscreen = function (a, b) {
            var c = a.find('button[data-event="fullscreen"]');
            c.toggleClass("active", b)
        }, this.updateCodeview = function (a, b) {
            var c = a.find('button[data-event="codeview"]');
            c.toggleClass("active", b)
        }
    }, w = function () {
        var b = new u, c = function (b, c) {
            var d = a(b), e = c ? d.offset() : d.position(), f = d.outerHeight(!0);
            return {left: e.left, top: e.top + f}
        }, d = function (a, b) {
            a.css({display: "block", left: b.left, top: b.top})
        }, e = 20;
        this.update = function (h, i, j) {
            b.update(h, i);
            var k = h.find(".note-link-popover");
            if (i.anchor) {
                var l = k.find("a"), m = a(i.anchor).attr("href");
                l.attr("href", m).html(m), d(k, c(i.anchor, j))
            } else k.hide();
            var n = h.find(".note-image-popover");
            i.image ? d(n, c(i.image, j)) : n.hide();
            var o = h.find(".note-air-popover");
            if (j && !i.range.isCollapsed()) {
                var p = g.last(i.range.getClientRects());
                if (p) {
                    var q = f.rect2bnd(p);
                    d(o, {left: Math.max(q.left + q.width / 2 - e, 0), top: q.top + q.height})
                }
            } else o.hide()
        }, this.updateRecentColor = function (a, b, c) {
            a.updateRecentColor(a, b, c)
        }, this.hide = function (a) {
            a.children().hide()
        }
    }, x = function () {
        this.update = function (b, c, d) {
            var e = b.find(".note-control-selection");
            if (c.image) {
                var f = a(c.image), g = d ? f.offset() : f.position(), h = {w: f.outerWidth(!0), h: f.outerHeight(!0)};
                e.css({display: "block", left: g.left, top: g.top, width: h.w, height: h.h}).data("target", c.image);
                var i = h.w + "x" + h.h;
                e.find(".note-control-selection-info").text(i)
            } else e.hide()
        }, this.hide = function (a) {
            a.children().hide()
        }
    }, y = function () {
        var b = function (a, b) {
            a.toggleClass("disabled", !b), a.attr("disabled", !b)
        };
        this.showImageDialog = function (c, d) {
            return a.Deferred(function (a) {
                var c = d.find(".note-image-dialog"), e = d.find(".note-image-input"), f = d.find(".note-image-url"), g = d.find(".note-image-btn");
                c.one("shown.bs.modal", function () {
                    e.replaceWith(e.clone().on("change", function () {
                        a.resolve(this.files || this.value), c.modal("hide")
                    }).val("")), g.click(function (b) {
                        b.preventDefault(), a.resolve(f.val()), c.modal("hide")
                    }), f.on("keyup paste", function (a) {
                        var c;
                        c = "paste" === a.type ? a.originalEvent.clipboardData.getData("text") : f.val(), b(g, c)
                    }).val("").trigger("focus")
                }).one("hidden.bs.modal", function () {
                    e.off("change"), f.off("keyup paste"), g.off("click"), "pending" === a.state() && a.reject()
                }).modal("show")
            })
        }, this.showLinkDialog = function (c, d, e) {
            return a.Deferred(function (a) {
                var c = d.find(".note-link-dialog"), f = c.find(".note-link-text"), g = c.find(".note-link-url"), h = c.find(".note-link-btn"), i = c.find("input[type=checkbox]");
                c.one("shown.bs.modal", function () {
                    f.val(e.text), f.on("input", function () {
                        e.text = f.val()
                    }), e.url || (e.url = e.text, b(h, e.text)), g.on("input", function () {
                        b(h, g.val()), e.text || f.val(g.val())
                    }).val(e.url).trigger("focus").trigger("select"), i.prop("checked", e.newWindow), h.one("click", function (b) {
                        b.preventDefault(), a.resolve({
                            range: e.range,
                            url: g.val(),
                            text: f.val(),
                            newWindow: i.is(":checked")
                        }), c.modal("hide")
                    })
                }).one("hidden.bs.modal", function () {
                    f.off("input"), g.off("input"), h.off("click"), "pending" === a.state() && a.reject()
                }).modal("show")
            }).promise()
        }, this.showHelpDialog = function (b, c) {
            return a.Deferred(function (a) {
                var b = c.find(".note-help-dialog");
                b.one("hidden.bs.modal", function () {
                    a.resolve()
                }).modal("show")
            }).promise()
        }
    };
    e.hasCodeMirror && (e.isSupportAmd ? require(["CodeMirror"], function (a) {
        b = a
    }) : b = window.CodeMirror);
    var z = function () {
        var c = a(window), d = a(document), f = a("html, body"), h = new s, i = new v, k = new w, l = new x, o = new y;
        this.getEditor = function () {
            return h
        };
        var p = function (b) {
            var c = a(b).closest(".note-editor, .note-air-editor, .note-air-layout");
            if (!c.length)return null;
            var d;
            return d = c.is(".note-editor, .note-air-editor") ? c : a("#note-editor-" + g.last(c.attr("id").split("-"))), j.buildLayoutInfo(d)
        }, q = function (b, c) {
            var d = b.editor(), e = b.editable(), f = e.data("callbacks"), g = d.data("options");
            f.onImageUpload ? f.onImageUpload(c, h, e) : a.each(c, function (a, b) {
                var c = b.name;
                g.maximumImageFileSize && g.maximumImageFileSize < b.size ? f.onImageUploadError ? f.onImageUploadError(g.langInfo.image.maximumFileSizeError) : alert(g.langInfo.image.maximumFileSizeError) : m.readFileAsDataURL(b).then(function (a) {
                    h.insertImage(e, a, c)
                }).fail(function () {
                    f.onImageUploadError && f.onImageUploadError()
                })
            })
        }, r = {
            showLinkDialog: function (a) {
                var b = a.editor(), c = a.dialog(), d = a.editable(), e = h.getLinkInfo(d), f = b.data("options");
                h.saveRange(d), o.showLinkDialog(d, c, e).then(function (b) {
                    h.restoreRange(d), h.createLink(d, b, f), k.hide(a.popover())
                }).fail(function () {
                    h.restoreRange(d)
                })
            }, showImageDialog: function (a) {
                var b = a.dialog(), c = a.editable();
                h.saveRange(c), o.showImageDialog(c, b).then(function (b) {
                    h.restoreRange(c), "string" == typeof b ? h.insertImage(c, b) : q(a, b)
                }).fail(function () {
                    h.restoreRange(c)
                })
            }, showHelpDialog: function (a) {
                var b = a.dialog(), c = a.editable();
                h.saveRange(c, !0), o.showHelpDialog(c, b).then(function () {
                    h.restoreRange(c)
                })
            }, fullscreen: function (a) {
                var b = a.editor(), d = a.toolbar(), e = a.editable(), g = a.codable(), h = function (a) {
                    e.css("height", a.h), g.css("height", a.h), g.data("cmeditor") && g.data("cmeditor").setsize(null, a.h)
                };
                b.toggleClass("fullscreen");
                var j = b.hasClass("fullscreen");
                j ? (e.data("orgheight", e.css("height")), c.on("resize", function () {
                    h({h: c.height() - d.outerHeight()})
                }).trigger("resize"), f.css("overflow", "hidden")) : (c.off("resize"), h({h: e.data("orgheight")}), f.css("overflow", "visible")), i.updateFullscreen(d, j)
            }, codeview: function (a) {
                var c, d, f = a.editor(), g = a.toolbar(), h = a.editable(), m = a.codable(), n = a.popover(), o = a.handle(), p = f.data("options");
                f.toggleClass("codeview");
                var q = f.hasClass("codeview");
                q ? (m.val(j.html(h, p.prettifyHtml)), m.height(h.height()), i.deactivate(g), k.hide(n), l.hide(o), m.focus(), e.hasCodeMirror && (c = b.fromTextArea(m[0], p.codemirror), p.codemirror.tern && (d = new b.TernServer(p.codemirror.tern), c.ternServer = d, c.on("cursorActivity", function (a) {
                    d.updateArgHints(a)
                })), c.setSize(null, h.outerHeight()), m.data("cmEditor", c))) : (e.hasCodeMirror && (c = m.data("cmEditor"), m.val(c.getValue()), c.toTextArea()), h.html(j.value(m, p.prettifyHtml) || j.emptyPara), h.height(p.height ? m.height() : "auto"), i.activate(g), h.focus()), i.updateCodeview(a.toolbar(), q)
            }
        }, u = function (a) {
            j.isImg(a.target) && a.preventDefault()
        }, z = function (a) {
            setTimeout(function () {
                var b = p(a.currentTarget || a.target), c = h.currentStyle(a.target);
                if (c) {
                    var d = b.editor().data("options").airMode;
                    d || i.update(b.toolbar(), c), k.update(b.popover(), c, d), l.update(b.handle(), c, d)
                }
            }, 0)
        }, A = function (a) {
            var b = p(a.currentTarget || a.target);
            k.hide(b.popover()), l.hide(b.handle())
        }, B = function (a) {
            var b = a.originalEvent.clipboardData, c = p(a.currentTarget || a.target), d = c.editable();
            if (!b || !b.items || !b.items.length) {
                var e = d.data("callbacks");
                if (!e.onImageUpload)return;
                return h.saveNode(d), h.saveRange(d), d.html(""), void setTimeout(function () {
                    for (var a = d.find("img"), b = a[0].src, e = atob(b.split(",")[1]), f = new Uint8Array(e.length), g = 0; g < e.length; g++)f[g] = e.charCodeAt(g);
                    var i = new Blob([f], {type: "image/png"});
                    i.name = "clipboard.png", h.restoreNode(d), h.restoreRange(d), q(c, [i]), h.afterCommand(d)
                }, 0)
            }
            var f = g.head(b.items), i = "file" === f.kind && -1 !== f.type.indexOf("image/");
            i && q(c, [f.getAsFile()]), h.afterCommand(d)
        }, C = function (b) {
            if (j.isControlSizing(b.target)) {
                b.preventDefault(), b.stopPropagation();
                var c = p(b.target), e = c.handle(), f = c.popover(), g = c.editable(), i = c.editor(), m = e.find(".note-control-selection").data("target"), n = a(m), o = n.offset(), q = d.scrollTop(), r = i.data("options").airMode;
                d.on("mousemove", function (a) {
                    h.resizeTo({
                        x: a.clientX - o.left,
                        y: a.clientY - (o.top - q)
                    }, n, !a.shiftKey), l.update(e, {image: m}, r), k.update(f, {image: m}, r)
                }).one("mouseup", function () {
                    d.off("mousemove"), h.afterCommand(g)
                }), n.data("ratio") || n.data("ratio", n.height() / n.width())
            }
        }, D = function (b) {
            var c = a(b.target).closest("[data-event]");
            c.length && b.preventDefault()
        }, E = function (b) {
            var c = a(b.target).closest("[data-event]");
            if (c.length) {
                var d, e = c.attr("data-event"), f = c.attr("data-value"), j = c.attr("data-hide"), l = p(b.target);
                if (-1 !== a.inArray(e, ["resize", "floatMe", "removeMedia", "imageShape"])) {
                    var m = l.handle().find(".note-control-selection");
                    d = a(m.data("target"))
                }
                if (j && c.parents(".popover").hide(), a.isFunction(a.summernote.pluginEvents[e]))a.summernote.pluginEvents[e](b, h, l, f); else if (h[e]) {
                    var n = l.editable();
                    n.trigger("focus"), h[e](n, f, d), b.preventDefault()
                } else r[e] && (r[e].call(this, l), b.preventDefault());
                if (-1 !== a.inArray(e, ["backColor", "foreColor"])) {
                    var o = l.editor().data("options", o), q = o.airMode ? k : i;
                    q.updateRecentColor(g.head(c), e, f)
                }
                z(b)
            }
        }, F = 24, G = function (a) {
            a.preventDefault(), a.stopPropagation();
            var b = p(a.target).editable(), c = b.offset().top - d.scrollTop(), e = p(a.currentTarget || a.target), f = e.editor().data("options");
            d.on("mousemove", function (a) {
                var d = a.clientY - (c + F);
                d = f.minHeight > 0 ? Math.max(d, f.minHeight) : d, d = f.maxHeight > 0 ? Math.min(d, f.maxHeight) : d, b.height(d)
            }).one("mouseup", function () {
                d.off("mousemove")
            })
        }, H = 18, I = function (b, c) {
            var d, e = a(b.target.parentNode), f = e.next(), g = e.find(".note-dimension-picker-mousecatcher"), h = e.find(".note-dimension-picker-highlighted"), i = e.find(".note-dimension-picker-unhighlighted");
            if (void 0 === b.offsetX) {
                var j = a(b.target).offset();
                d = {x: b.pageX - j.left, y: b.pageY - j.top}
            } else d = {x: b.offsetX, y: b.offsetY};
            var k = {c: Math.ceil(d.x / H) || 1, r: Math.ceil(d.y / H) || 1};
            h.css({
                width: k.c + "em",
                height: k.r + "em"
            }), g.attr("data-value", k.c + "x" + k.r), 3 < k.c && k.c < c.insertTableMaxSize.col && i.css({width: k.c + 1 + "em"}), 3 < k.r && k.r < c.insertTableMaxSize.row && i.css({height: k.r + 1 + "em"}), f.html(k.c + " x " + k.r)
        }, J = function (a, b) {
            b.disableDragAndDrop ? d.on("drop", function (a) {
                a.preventDefault()
            }) : K(a, b)
        }, K = function (b, c) {
            var e = a(), f = b.dropzone, g = b.dropzone.find(".note-dropzone-message");
            d.on("dragenter", function (a) {
                var d = b.editor.hasClass("codeview");
                d || e.length || (b.editor.addClass("dragover"), f.width(b.editor.width()), f.height(b.editor.height()), g.text(c.langInfo.image.dragImageHere)), e = e.add(a.target)
            }).on("dragleave", function (a) {
                e = e.not(a.target), e.length || b.editor.removeClass("dragover")
            }).on("drop", function () {
                e = a(), b.editor.removeClass("dragover")
            }).on("mouseout", function (a) {
                e = e.not(a.target), e.length || b.editor.removeClass("dragover")
            }), f.on("dragenter", function () {
                f.addClass("hover"), g.text(c.langInfo.image.dropImage)
            }).on("dragleave", function () {
                f.removeClass("hover"), g.text(c.langInfo.image.dragImageHere)
            }), f.on("drop", function (b) {
                b.preventDefault();
                var c = b.originalEvent.dataTransfer, d = c.getData("text/html"), e = c.getData("text/plain"), f = p(b.currentTarget || b.target);
                c && c.files && c.files.length ? (f.editable().focus(), q(f, c.files)) : d ? a(d).each(function () {
                    f.editable().focus(), h.insertNode(f.editable(), this)
                }) : e && (f.editable().focus(), h.insertText(f.editable(), e))
            }).on("dragover", !1)
        };
        this.bindKeyMap = function (b, c) {
            var d = b.editor, e = b.editable;
            b = p(e), e.on("keydown", function (f) {
                var g = [];
                f.metaKey && g.push("CMD"), f.ctrlKey && !f.altKey && g.push("CTRL"), f.shiftKey && g.push("SHIFT");
                var i = n.nameFromCode[f.keyCode];
                i && g.push(i);
                var j = c[g.join("+")];
                if (j)if (a.summernote.pluginEvents[j]) {
                    var k = a.summernote.pluginEvents[j];
                    a.isFunction(k) && k(f, h, b)
                } else h[j] ? (h[j](e, d.data("options")), f.preventDefault()) : r[j] && (r[j].call(this, b), f.preventDefault()); else n.isEdit(f.keyCode) && h.afterCommand(e)
            })
        }, this.attach = function (a, b) {
            b.shortcuts && this.bindKeyMap(a, b.keyMap[e.isMac ? "mac" : "pc"]), a.editable.on("mousedown", u), a.editable.on("keyup mouseup", z), a.editable.on("scroll", A), a.editable.on("paste", B), a.handle.on("mousedown", C), a.popover.on("click", E), a.popover.on("mousedown", D), b.airMode || (J(a, b), a.toolbar.on("click", E), a.toolbar.on("mousedown", D), b.disableResizeEditor || a.statusbar.on("mousedown", G));
            var c = b.airMode ? a.popover : a.toolbar, d = c.find(".note-dimension-picker-mousecatcher");
            d.css({
                width: b.insertTableMaxSize.col + "em",
                height: b.insertTableMaxSize.row + "em"
            }).on("mousemove", function (a) {
                I(a, b)
            }), a.editor.data("options", b), e.isMSIE || setTimeout(function () {
                document.execCommand("styleWithCSS", 0, b.styleWithSpan)
            }, 0);
            var f = new t(a.editable);
            if (a.editable.data("NoteHistory", f), b.onenter && a.editable.keypress(function (a) {
                    a.keyCode === n.ENTER && b.onenter(a)
                }), b.onfocus && a.editable.focus(b.onfocus), b.onblur && a.editable.blur(b.onblur), b.onkeyup && a.editable.keyup(b.onkeyup), b.onkeydown && a.editable.keydown(b.onkeydown), b.onpaste && a.editable.on("paste", b.onpaste), b.onToolbarClick && a.toolbar.click(b.onToolbarClick), b.onChange) {
                var g = function () {
                    h.triggerOnChange(a.editable)
                };
                if (e.isMSIE) {
                    var i = "DOMCharacterDataModified DOMSubtreeModified DOMNodeInserted";
                    a.editable.on(i, g)
                } else a.editable.on("input", g)
            }
            a.editable.data("callbacks", {
                onBeforeChange: b.onBeforeChange,
                onChange: b.onChange,
                onAutoSave: b.onAutoSave,
                onImageUpload: b.onImageUpload,
                onImageUploadError: b.onImageUploadError,
                onFileUpload: b.onFileUpload,
                onFileUploadError: b.onFileUpload,
                onMediaDelete: b.onMediaDelete
            })
        }, this.detach = function (a, b) {
            a.editable.off(), a.popover.off(), a.handle.off(), a.dialog.off(), b.airMode || (a.dropzone.off(), a.toolbar.off(), a.statusbar.off())
        }
    }, A = function () {
        var b = function (a, b) {
            var c = b.event, d = b.value, e = b.title, f = b.className, g = b.dropdown, h = b.hide;
            return '<button type="button" class="btn btn-default btn-sm btn-small' + (f ? " " + f : "") + (g ? " dropdown-toggle" : "") + '"' + (g ? ' data-toggle="dropdown"' : "") + (e ? ' title="' + e + '"' : "") + (c ? ' data-event="' + c + '"' : "") + (d ? " data-value='" + d + "'" : "") + (h ? " data-hide='" + h + "'" : "") + ' tabindex="-1">' + a + (g ? ' <span class="caret"></span>' : "") + "</button>" + (g || "")
        }, c = function (a, c) {
            var d = '<i class="' + a + '"></i>';
            return b(d, c)
        }, d = function (a, b) {
            return '<div class="' + a + ' popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content">' + b + "</div></div>"
        }, g = function (a, b, c, d) {
            return '<div class="' + a + ' modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content">' + (b ? '<div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">&times;</button><h4 class="modal-title">' + b + "</h4></div>" : "") + '<form class="note-modal-form"><div class="modal-body">' + c + "</div>" + (d ? '<div class="modal-footer">' + d + "</div>" : "") + "</form></div></div></div>"
        }, h = {
            picture: function (a) {
                return c("fa fa-picture-o", {event: "showImageDialog", title: a.image.image, hide: !0})
            }, link: function (a) {
                return c("fa fa-link", {event: "showLinkDialog", title: a.link.link, hide: !0})
            }, table: function (a) {
                var b = '<ul class="note-table dropdown-menu"><div class="note-dimension-picker"><div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1"></div><div class="note-dimension-picker-highlighted"></div><div class="note-dimension-picker-unhighlighted"></div></div><div class="note-dimension-display"> 1 x 1 </div></ul>';
                return c("fa fa-table", {title: a.table.table, dropdown: b})
            }, style: function (a, b) {
                var d = b.styleTags.reduce(function (b, c) {
                    var d = a.style["p" === c ? "normal" : c];
                    return b + '<li><a data-event="formatBlock" href="#" data-value="' + c + '">' + ("p" === c || "pre" === c ? d : "<" + c + ">" + d + "</" + c + ">") + "</a></li>"
                }, "");
                return c("fa fa-magic", {title: a.style.style, dropdown: '<ul class="dropdown-menu">' + d + "</ul>"})
            }, fontname: function (a, c) {
                var d = c.fontNames.reduce(function (a, b) {
                    return e.isFontInstalled(b) || -1 !== c.fontNamesIgnoreCheck.indexOf(b) ? a + '<li><a data-event="fontName" href="#" data-value="' + b + '" style="font-family:\'' + b + '\'"><i class="fa fa-check"></i> ' + b + "</a></li>" : a
                }, ""), f = '<span class="note-current-fontname">' + c.defaultFontName + "</span>";
                return b(f, {title: a.font.name, dropdown: '<ul class="dropdown-menu">' + d + "</ul>"})
            }, color: function (a) {
                var c = '<i class="fa fa-font" style="color:black;background-color:yellow;"></i>', d = b(c, {
                    className: "note-recent-color",
                    title: a.color.recent,
                    event: "color",
                    value: '{"backColor":"yellow"}'
                }), e = '<ul class="dropdown-menu"><li><div class="btn-group"><div class="note-palette-title">' + a.color.background + '</div><div class="note-color-reset" data-event="backColor" data-value="inherit" title="' + a.color.transparent + '">' + a.color.setTransparent + '</div><div class="note-color-palette" data-target-event="backColor"></div></div><div class="btn-group"><div class="note-palette-title">' + a.color.foreground + '</div><div class="note-color-reset" data-event="foreColor" data-value="inherit" title="' + a.color.reset + '">' + a.color.resetToDefault + '</div><div class="note-color-palette" data-target-event="foreColor"></div></div></li></ul>', f = b("", {
                    title: a.color.more,
                    dropdown: e
                });
                return d + f
            }, bold: function (a) {
                return c("fa fa-bold", {event: "bold", title: a.font.bold})
            }, italic: function (a) {
                return c("fa fa-italic", {event: "italic", title: a.font.italic})
            }, underline: function (a) {
                return c("fa fa-underline", {event: "underline", title: a.font.underline})
            }, clear: function (a) {
                return c("fa fa-eraser", {event: "removeFormat", title: a.font.clear})
            }, ul: function (a) {
                return c("fa fa-list-ul", {event: "insertUnorderedList", title: a.lists.unordered})
            }, ol: function (a) {
                return c("fa fa-list-ol", {event: "insertOrderedList", title: a.lists.ordered})
            }, paragraph: function (a) {
                var b = c("fa fa-align-left", {
                    title: a.paragraph.left,
                    event: "justifyLeft"
                }), d = c("fa fa-align-center", {
                    title: a.paragraph.center,
                    event: "justifyCenter"
                }), e = c("fa fa-align-right", {
                    title: a.paragraph.right,
                    event: "justifyRight"
                }), f = c("fa fa-align-justify", {
                    title: a.paragraph.justify,
                    event: "justifyFull"
                }), g = c("fa fa-outdent", {
                    title: a.paragraph.outdent,
                    event: "outdent"
                }), h = c("fa fa-indent", {
                    title: a.paragraph.indent,
                    event: "indent"
                }), i = '<div class="dropdown-menu"><div class="note-align btn-group">' + b + d + e + f + '</div><div class="note-list btn-group">' + h + g + "</div></div>";
                return c("fa fa-align-left", {title: a.paragraph.paragraph, dropdown: i})
            }, height: function (a, b) {
                var d = b.lineHeights.reduce(function (a, b) {
                    return a + '<li><a data-event="lineHeight" href="#" data-value="' + parseFloat(b) + '"><i class="fa fa-check"></i> ' + b + "</a></li>"
                }, "");
                return c("fa fa-text-height", {
                    title: a.font.height,
                    dropdown: '<ul class="dropdown-menu">' + d + "</ul>"
                })
            }, help: function (a) {
                return c("fa fa-question", {event: "showHelpDialog", title: a.options.help, hide: !0})
            }, fullscreen: function (a) {
                return c("fa fa-arrows-alt", {event: "fullscreen", title: a.options.fullscreen})
            }, codeview: function (a) {
                return c("fa fa-code", {event: "codeview", title: a.options.codeview})
            }, undo: function (a) {
                return c("fa fa-undo", {event: "undo", title: a.history.undo})
            }, redo: function (a) {
                return c("fa fa-repeat", {event: "redo", title: a.history.redo})
            }, hr: function (a) {
                return c("fa fa-minus", {event: "insertHorizontalRule", title: a.hr.insert})
            }
        }, i = function (a, e) {
            var f = function () {
                var b = c("fa fa-edit", {
                    title: a.link.edit,
                    event: "showLinkDialog",
                    hide: !0
                }), e = c("fa fa-unlink", {
                    title: a.link.unlink,
                    event: "unlink"
                }), f = '<a href="http://www.google.com" target="_blank">www.google.com</a>&nbsp;&nbsp;<div class="note-insert btn-group">' + b + e + "</div>";
                return d("note-link-popover", f)
            }, g = function () {
                var e = b('<span class="note-fontsize-10">100%</span>', {
                    title: a.image.resizeFull,
                    event: "resize",
                    value: "1"
                }), f = b('<span class="note-fontsize-10">50%</span>', {
                    title: a.image.resizeHalf,
                    event: "resize",
                    value: "0.5"
                }), g = b('<span class="note-fontsize-10">25%</span>', {
                    title: a.image.resizeQuarter,
                    event: "resize",
                    value: "0.25"
                }), h = c("fa fa-align-left", {
                    title: a.image.floatLeft,
                    event: "floatMe",
                    value: "left"
                }), i = c("fa fa-align-right", {
                    title: a.image.floatRight,
                    event: "floatMe",
                    value: "right"
                }), j = c("fa fa-align-justify", {
                    title: a.image.floatNone,
                    event: "floatMe",
                    value: "none"
                }), k = c("fa fa-square", {
                    title: a.image.shapeRounded,
                    event: "imageShape",
                    value: "img-rounded"
                }), l = c("fa fa-circle-o", {
                    title: a.image.shapeCircle,
                    event: "imageShape",
                    value: "img-circle"
                }), m = c("fa fa-picture-o", {
                    title: a.image.shapeThumbnail,
                    event: "imageShape",
                    value: "img-thumbnail"
                }), n = c("fa fa-times", {
                    title: a.image.shapeNone,
                    event: "imageShape",
                    value: ""
                }), o = c("fa fa-trash-o", {
                    title: a.image.remove,
                    event: "removeMedia",
                    value: "none"
                }), p = '<div class="btn-group">' + e + f + g + '</div><div class="btn-group">' + h + i + j + '</div><div class="btn-group">' + k + l + m + n + '</div><div class="btn-group">' + o + "</div>";
                return d("note-image-popover", p)
            }, i = function () {
                for (var b = "", c = 0, f = e.airPopover.length; f > c; c++) {
                    var g = e.airPopover[c];
                    b += '<div class="note-' + g[0] + ' btn-group">';
                    for (var i = 0, j = g[1].length; j > i; i++)b += h[g[1][i]](a, e);
                    b += "</div>"
                }
                return d("note-air-popover", b)
            };
            return '<div class="note-popover">' + f() + g() + (e.airMode ? i() : "") + "</div>"
        }, k = function () {
            return '<div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div>'
        }, l = function (a, b) {
            var c = "note-shortcut-col col-xs-6 note-shortcut-", d = [];
            for (var e in b)b.hasOwnProperty(e) && d.push('<div class="' + c + 'key">' + b[e].kbd + '</div><div class="' + c + 'name">' + b[e].text + "</div>");
            return '<div class="note-shortcut-row row"><div class="' + c + 'title col-xs-offset-6">' + a + '</div></div><div class="note-shortcut-row row">' + d.join('</div><div class="note-shortcut-row row">') + "</div>"
        }, m = function (a) {
            var b = [{kbd: "⌘ + B", text: a.font.bold}, {kbd: "⌘ + I", text: a.font.italic}, {
                kbd: "⌘ + U",
                text: a.font.underline
            }, {kbd: "⌘ + \\", text: a.font.clear}];
            return l(a.shortcut.textFormatting, b)
        }, n = function (a) {
            var b = [{kbd: "⌘ + Z", text: a.history.undo}, {kbd: "⌘ + ⇧ + Z", text: a.history.redo}, {
                kbd: "⌘ + ]",
                text: a.paragraph.indent
            }, {kbd: "⌘ + [", text: a.paragraph.outdent}, {kbd: "⌘ + ENTER", text: a.hr.insert}];
            return l(a.shortcut.action, b)
        }, o = function (a) {
            var b = [{kbd: "⌘ + ⇧ + L", text: a.paragraph.left}, {
                kbd: "⌘ + ⇧ + E",
                text: a.paragraph.center
            }, {kbd: "⌘ + ⇧ + R", text: a.paragraph.right}, {
                kbd: "⌘ + ⇧ + J",
                text: a.paragraph.justify
            }, {kbd: "⌘ + ⇧ + NUM7", text: a.lists.ordered}, {kbd: "⌘ + ⇧ + NUM8", text: a.lists.unordered}];
            return l(a.shortcut.paragraphFormatting, b)
        }, p = function (a) {
            var b = [{kbd: "⌘ + NUM0", text: a.style.normal}, {kbd: "⌘ + NUM1", text: a.style.h1}, {
                kbd: "⌘ + NUM2",
                text: a.style.h2
            }, {kbd: "⌘ + NUM3", text: a.style.h3}, {kbd: "⌘ + NUM4", text: a.style.h4}, {
                kbd: "⌘ + NUM5",
                text: a.style.h5
            }, {kbd: "⌘ + NUM6", text: a.style.h6}];
            return l(a.shortcut.documentStyle, b)
        }, q = function (a, b) {
            var c = b.extraKeys, d = [];
            for (var e in c)c.hasOwnProperty(e) && d.push({kbd: e, text: c[e]});
            return l(a.shortcut.extraKeys, d)
        }, r = function (a, b) {
            var c = 'class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"', d = ["<div " + c + ">" + n(a, b) + "</div><div " + c + ">" + m(a, b) + "</div>", "<div " + c + ">" + p(a, b) + "</div><div " + c + ">" + o(a, b) + "</div>"];
            return b.extraKeys && d.push("<div " + c + ">" + q(a, b) + "</div>"), '<div class="note-shortcut-row row">' + d.join('</div><div class="note-shortcut-row row">') + "</div>"
        }, s = function (a) {
            return a.replace(/⌘/g, "Ctrl").replace(/⇧/g, "Shift")
        }, t = {
            image: function (a, b) {
                var c = "";
                if (b.maximumImageFileSize) {
                    var d = Math.floor(Math.log(b.maximumImageFileSize) / Math.log(1024)), e = 1 * (b.maximumImageFileSize / Math.pow(1024, d)).toFixed(2) + " " + " KMGTP"[d] + "B";
                    c = "<small>" + a.image.maximumFileSize + " : " + e + "</small>"
                }
                var f = '<div class="form-group row-fluid note-group-select-from-files"><label>' + a.image.selectFromFiles + '</label><input class="note-image-input" type="file" name="files" accept="image/*" multiple="multiple" />' + c + '</div><div class="form-group row-fluid"><label>' + a.image.url + '</label><input class="note-image-url form-control span12" type="text" /></div>', h = '<button href="#" class="btn btn-primary note-image-btn disabled" disabled>' + a.image.insert + "</button>";
                return g("note-image-dialog", a.image.insert, f, h)
            }, link: function (a, b) {
                var c = '<div class="form-group row-fluid"><label>' + a.link.textToDisplay + '</label><input class="note-link-text form-control span12" type="text" /></div><div class="form-group row-fluid"><label>' + a.link.url + '</label><input class="note-link-url form-control span12" type="text" /></div>' + (b.disableLinkTarget ? "" : '<div class="checkbox"><label><input type="checkbox" checked> ' + a.link.openInNewWindow + "</label></div>"), d = '<button href="#" class="btn btn-primary note-link-btn disabled" disabled>' + a.link.insert + "</button>";
                return g("note-link-dialog", a.link.insert, c, d)
            }, help: function (a, b) {
                var c = '<a class="modal-close pull-right" aria-hidden="true" tabindex="-1">' + a.shortcut.close + '</a><div class="title">' + a.shortcut.shortcuts + "</div>" + (e.isMac ? r(a, b) : s(r(a, b))) + '<p class="text-center"><a href="//summernote.org/" target="_blank">Summernote 0.6.1</a> · <a href="//github.com/summernote/summernote" target="_blank">Project</a> · <a href="//github.com/summernote/summernote/issues" target="_blank">Issues</a></p>';
                return g("note-help-dialog", "", c, "")
            }
        }, u = function (b, c) {
            var d = "";
            return a.each(t, function (a, e) {
                d += e(b, c)
            }), '<div class="note-dialog">' + d + "</div>"
        }, v = function () {
            return '<div class="note-resizebar"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div>'
        }, w = function (a) {
            return e.isMac && (a = a.replace("CMD", "⌘").replace("SHIFT", "⇧")), a.replace("BACKSLASH", "\\").replace("SLASH", "/").replace("LEFTBRACKET", "[").replace("RIGHTBRACKET", "]")
        }, x = function (b, c, d) {
            var e = f.invertObject(c), g = b.find("button");
            g.each(function (b, c) {
                var d = a(c), f = e[d.data("event")];
                f && d.attr("title", function (a, b) {
                    return b + " (" + w(f) + ")"
                })
            }).tooltip({container: "body", trigger: "hover", placement: d || "top"}).on("click", function () {
                a(this).tooltip("hide")
            })
        }, y = function (b, c) {
            var d = c.colors;
            b.find(".note-color-palette").each(function () {
                for (var b = a(this), c = b.attr("data-target-event"), e = [], f = 0, g = d.length; g > f; f++) {
                    for (var h = d[f], i = [], j = 0, k = h.length; k > j; j++) {
                        var l = h[j];
                        i.push(['<button type="button" class="note-color-btn" style="background-color:', l, ';" data-event="', c, '" data-value="', l, '" title="', l, '" data-toggle="button" tabindex="-1"></button>'].join(""))
                    }
                    e.push('<div class="note-color-row">' + i.join("") + "</div>")
                }
                b.html(e.join(""))
            })
        };
        this.createLayoutByAirMode = function (b, c) {
            var d = c.langInfo, g = c.keyMap[e.isMac ? "mac" : "pc"], h = f.uniqueId();
            b.addClass("note-air-editor note-editable"), b.attr({id: "note-editor-" + h, contentEditable: !0});
            var j = document.body, l = a(i(d, c));
            l.addClass("note-air-layout"), l.attr("id", "note-popover-" + h), l.appendTo(j), x(l, g), y(l, c);
            var m = a(k());
            m.addClass("note-air-layout"), m.attr("id", "note-handle-" + h), m.appendTo(j);
            var n = a(u(d, c));
            n.addClass("note-air-layout"), n.attr("id", "note-dialog-" + h), n.find("button.close, a.modal-close").click(function () {
                a(this).closest(".modal").modal("hide")
            }), n.appendTo(j)
        }, this.createLayoutByFrame = function (b, c) {
            var d = c.langInfo, f = a('<div class="note-editor"></div>');
            c.width && f.width(c.width), c.height > 0 && a('<div class="note-statusbar">' + (c.disableResizeEditor ? "" : v()) + "</div>").prependTo(f);
            var g = !b.is(":disabled"), l = a('<div class="note-editable" contentEditable="' + g + '"></div>').prependTo(f);
            c.height && l.height(c.height), c.direction && l.attr("dir", c.direction);
            var m = b.attr("placeholder") || c.placeholder;
            m && l.attr("data-placeholder", m), l.html(j.html(b)), a('<textarea class="note-codable"></textarea>').prependTo(f);
            for (var n = "", o = 0, p = c.toolbar.length; p > o; o++) {
                var q = c.toolbar[o][0], r = c.toolbar[o][1];
                n += '<div class="note-' + q + ' btn-group">';
                for (var s = 0, t = r.length; t > s; s++) {
                    var w = h[r[s]];
                    a.isFunction(w) && (n += w(d, c))
                }
                n += "</div>"
            }
            n = '<div class="note-toolbar btn-toolbar">' + n + "</div>";
            var z = a(n).prependTo(f), A = c.keyMap[e.isMac ? "mac" : "pc"];
            y(z, c), x(z, A, "bottom");
            var B = a(i(d, c)).prependTo(f);
            y(B, c), x(B, A), a(k()).prependTo(f);
            var C = a(u(d, c)).prependTo(f);
            C.find("button.close, a.modal-close").click(function () {
                a(this).closest(".modal").modal("hide")
            }), a('<div class="note-dropzone"><div class="note-dropzone-message"></div></div>').prependTo(f), f.insertAfter(b), b.hide()
        }, this.noteEditorFromHolder = function (b) {
            return b.hasClass("note-air-editor") ? b : b.next().hasClass("note-editor") ? b.next() : a()
        }, this.createLayout = function (a, b) {
            this.noteEditorFromHolder(a).length || (b.airMode ? this.createLayoutByAirMode(a, b) : this.createLayoutByFrame(a, b))
        }, this.layoutInfoFromHolder = function (a) {
            var b = this.noteEditorFromHolder(a);
            if (b.length) {
                var c = j.buildLayoutInfo(b);
                for (var d in c)c.hasOwnProperty(d) && (c[d] = c[d].call());
                return c
            }
        }, this.removeLayout = function (a, b, c) {
            c.airMode ? (a.removeClass("note-air-editor note-editable").removeAttr("id contentEditable"), b.popover.remove(), b.handle.remove(), b.dialog.remove()) : (a.html(b.editable.html()), b.editor.remove(), a.show())
        }, this.getTemplate = function () {
            return {button: b, iconButton: c, dialog: g}
        }, this.addButtonInfo = function (a, b) {
            h[a] = b
        }, this.addDialogInfo = function (a, b) {
            t[a] = b
        }
    };
    a.summernote = a.summernote || {}, a.extend(a.summernote, l);
    var B = new A, C = new z;
    a.extend(a.summernote, {
        renderer: B,
        eventHandler: C,
        core: {agent: e, dom: j, range: k},
        pluginEvents: {}
    }), a.summernote.addPlugin = function (b) {
        b.buttons && a.each(b.buttons, function (a, b) {
            B.addButtonInfo(a, b)
        }), b.dialogs && a.each(b.dialogs, function (a, b) {
            B.addDialogInfo(a, b)
        }), b.events && a.each(b.events, function (b, c) {
            a.summernote.pluginEvents[b] = c
        }), b.langs && a.each(b.langs, function (b, c) {
            a.summernote.lang[b] && a.extend(a.summernote.lang[b], c)
        }), b.options && a.extend(a.summernote.options, b.options)
    }, a.fn.extend({
        summernote: function (b) {
            if (b = a.extend({}, a.summernote.options, b), b.langInfo = a.extend(!0, {}, a.summernote.lang["en-US"], a.summernote.lang[b.lang]), this.each(function (c, d) {
                    var e = a(d);
                    B.createLayout(e, b);
                    var f = B.layoutInfoFromHolder(e);
                    C.attach(f, b), j.isTextarea(e[0]) && e.closest("form").submit(function () {
                        var a = e.code();
                        e.val(a), b.onsubmit && b.onsubmit(a)
                    })
                }), this.first().length && b.focus) {
                var c = B.layoutInfoFromHolder(this.first());
                c.editable.focus()
            }
            return this.length && b.oninit && b.oninit(), this
        }, code: function (b) {
            if (void 0 === b) {
                var c = this.first();
                if (!c.length)return;
                var d = B.layoutInfoFromHolder(c);
                if (d && d.editable) {
                    var f = d.editor.hasClass("codeview");
                    return f && e.hasCodeMirror && d.codable.data("cmEditor").save(), f ? d.codable.val() : d.editable.html()
                }
                return j.isTextarea(c[0]) ? c.val() : c.html()
            }
            return this.each(function (c, d) {
                var e = B.layoutInfoFromHolder(a(d));
                e && e.editable && e.editable.html(b)
            }), this
        }, destroy: function () {
            return this.each(function (b, c) {
                var d = a(c), e = B.layoutInfoFromHolder(d);
                if (e && e.editable) {
                    var f = e.editor.data("options");
                    C.detach(e, f), B.removeLayout(d, e, f)
                }
            }), this
        }
    })
});
if (!document.createElement("canvas").getContext) {
    (function () {
        var z = Math;
        var K = z.round;
        var J = z.sin;
        var U = z.cos;
        var b = z.abs;
        var k = z.sqrt;
        var D = 10;
        var F = D / 2;

        function T() {
            return this.context_ || (this.context_ = new W(this))
        }

        var O = Array.prototype.slice;

        function G(i, j, m) {
            var Z = O.call(arguments, 2);
            return function () {
                return i.apply(j, Z.concat(O.call(arguments)))
            }
        }

        function AD(Z) {
            return String(Z).replace(/&/g, "&amp;").replace(/"/g, "&quot;")
        }

        function r(i) {
            if (!i.namespaces.g_vml_) {
                i.namespaces.add("g_vml_", "urn:schemas-microsoft-com:vml", "#default#VML")
            }
            if (!i.namespaces.g_o_) {
                i.namespaces.add("g_o_", "urn:schemas-microsoft-com:office:office", "#default#VML")
            }
            if (!i.styleSheets.ex_canvas_) {
                var Z = i.createStyleSheet();
                Z.owningElement.id = "ex_canvas_";
                Z.cssText = "canvas{display:inline-block;overflow:hidden;text-align:left;width:300px;height:150px}"
            }
        }

        r(document);
        var E = {
            init: function (Z) {
                if (/MSIE/.test(navigator.userAgent) && !window.opera) {
                    var i = Z || document;
                    i.createElement("canvas");
                    i.attachEvent("onreadystatechange", G(this.init_, this, i))
                }
            }, init_: function (m) {
                var j = m.getElementsByTagName("canvas");
                for (var Z = 0; Z < j.length; Z++) {
                    this.initElement(j[Z])
                }
            }, initElement: function (i) {
                if (!i.getContext) {
                    i.getContext = T;
                    r(i.ownerDocument);
                    i.innerHTML = "";
                    i.attachEvent("onpropertychange", S);
                    i.attachEvent("onresize", w);
                    var Z = i.attributes;
                    if (Z.width && Z.width.specified) {
                        i.style.width = Z.width.nodeValue + "px"
                    } else {
                        i.width = i.clientWidth
                    }
                    if (Z.height && Z.height.specified) {
                        i.style.height = Z.height.nodeValue + "px"
                    } else {
                        i.height = i.clientHeight
                    }
                }
                return i
            }
        };

        function S(i) {
            var Z = i.srcElement;
            switch (i.propertyName) {
                case"width":
                    Z.getContext().clearRect();
                    Z.style.width = Z.attributes.width.nodeValue + "px";
                    Z.firstChild.style.width = Z.clientWidth + "px";
                    break;
                case"height":
                    Z.getContext().clearRect();
                    Z.style.height = Z.attributes.height.nodeValue + "px";
                    Z.firstChild.style.height = Z.clientHeight + "px";
                    break
            }
        }

        function w(i) {
            var Z = i.srcElement;
            if (Z.firstChild) {
                Z.firstChild.style.width = Z.clientWidth + "px";
                Z.firstChild.style.height = Z.clientHeight + "px"
            }
        }

        E.init();
        var I = [];
        for (var AC = 0; AC < 16; AC++) {
            for (var AB = 0; AB < 16; AB++) {
                I[AC * 16 + AB] = AC.toString(16) + AB.toString(16)
            }
        }
        function V() {
            return [[1, 0, 0], [0, 1, 0], [0, 0, 1]]
        }

        function d(m, j) {
            var i = V();
            for (var Z = 0; Z < 3; Z++) {
                for (var AF = 0; AF < 3; AF++) {
                    var p = 0;
                    for (var AE = 0; AE < 3; AE++) {
                        p += m[Z][AE] * j[AE][AF]
                    }
                    i[Z][AF] = p
                }
            }
            return i
        }

        function Q(i, Z) {
            Z.fillStyle = i.fillStyle;
            Z.lineCap = i.lineCap;
            Z.lineJoin = i.lineJoin;
            Z.lineWidth = i.lineWidth;
            Z.miterLimit = i.miterLimit;
            Z.shadowBlur = i.shadowBlur;
            Z.shadowColor = i.shadowColor;
            Z.shadowOffsetX = i.shadowOffsetX;
            Z.shadowOffsetY = i.shadowOffsetY;
            Z.strokeStyle = i.strokeStyle;
            Z.globalAlpha = i.globalAlpha;
            Z.font = i.font;
            Z.textAlign = i.textAlign;
            Z.textBaseline = i.textBaseline;
            Z.arcScaleX_ = i.arcScaleX_;
            Z.arcScaleY_ = i.arcScaleY_;
            Z.lineScale_ = i.lineScale_
        }

        var B = {
            aliceblue: "#F0F8FF",
            antiquewhite: "#FAEBD7",
            aquamarine: "#7FFFD4",
            azure: "#F0FFFF",
            beige: "#F5F5DC",
            bisque: "#FFE4C4",
            black: "#000000",
            blanchedalmond: "#FFEBCD",
            blueviolet: "#8A2BE2",
            brown: "#A52A2A",
            burlywood: "#DEB887",
            cadetblue: "#5F9EA0",
            chartreuse: "#7FFF00",
            chocolate: "#D2691E",
            coral: "#FF7F50",
            cornflowerblue: "#6495ED",
            cornsilk: "#FFF8DC",
            crimson: "#DC143C",
            cyan: "#00FFFF",
            darkblue: "#00008B",
            darkcyan: "#008B8B",
            darkgoldenrod: "#B8860B",
            darkgray: "#A9A9A9",
            darkgreen: "#006400",
            darkgrey: "#A9A9A9",
            darkkhaki: "#BDB76B",
            darkmagenta: "#8B008B",
            darkolivegreen: "#556B2F",
            darkorange: "#FF8C00",
            darkorchid: "#9932CC",
            darkred: "#8B0000",
            darksalmon: "#E9967A",
            darkseagreen: "#8FBC8F",
            darkslateblue: "#483D8B",
            darkslategray: "#2F4F4F",
            darkslategrey: "#2F4F4F",
            darkturquoise: "#00CED1",
            darkviolet: "#9400D3",
            deeppink: "#FF1493",
            deepskyblue: "#00BFFF",
            dimgray: "#696969",
            dimgrey: "#696969",
            dodgerblue: "#1E90FF",
            firebrick: "#B22222",
            floralwhite: "#FFFAF0",
            forestgreen: "#228B22",
            gainsboro: "#DCDCDC",
            ghostwhite: "#F8F8FF",
            gold: "#FFD700",
            goldenrod: "#DAA520",
            grey: "#808080",
            greenyellow: "#ADFF2F",
            honeydew: "#F0FFF0",
            hotpink: "#FF69B4",
            indianred: "#CD5C5C",
            indigo: "#4B0082",
            ivory: "#FFFFF0",
            khaki: "#F0E68C",
            lavender: "#E6E6FA",
            lavenderblush: "#FFF0F5",
            lawngreen: "#7CFC00",
            lemonchiffon: "#FFFACD",
            lightblue: "#ADD8E6",
            lightcoral: "#F08080",
            lightcyan: "#E0FFFF",
            lightgoldenrodyellow: "#FAFAD2",
            lightgreen: "#90EE90",
            lightgrey: "#D3D3D3",
            lightpink: "#FFB6C1",
            lightsalmon: "#FFA07A",
            lightseagreen: "#20B2AA",
            lightskyblue: "#87CEFA",
            lightslategray: "#778899",
            lightslategrey: "#778899",
            lightsteelblue: "#B0C4DE",
            lightyellow: "#FFFFE0",
            limegreen: "#32CD32",
            linen: "#FAF0E6",
            magenta: "#FF00FF",
            mediumaquamarine: "#66CDAA",
            mediumblue: "#0000CD",
            mediumorchid: "#BA55D3",
            mediumpurple: "#9370DB",
            mediumseagreen: "#3CB371",
            mediumslateblue: "#7B68EE",
            mediumspringgreen: "#00FA9A",
            mediumturquoise: "#48D1CC",
            mediumvioletred: "#C71585",
            midnightblue: "#191970",
            mintcream: "#F5FFFA",
            mistyrose: "#FFE4E1",
            moccasin: "#FFE4B5",
            navajowhite: "#FFDEAD",
            oldlace: "#FDF5E6",
            olivedrab: "#6B8E23",
            orange: "#FFA500",
            orangered: "#FF4500",
            orchid: "#DA70D6",
            palegoldenrod: "#EEE8AA",
            palegreen: "#98FB98",
            paleturquoise: "#AFEEEE",
            palevioletred: "#DB7093",
            papayawhip: "#FFEFD5",
            peachpuff: "#FFDAB9",
            peru: "#CD853F",
            pink: "#FFC0CB",
            plum: "#DDA0DD",
            powderblue: "#B0E0E6",
            rosybrown: "#BC8F8F",
            royalblue: "#4169E1",
            saddlebrown: "#8B4513",
            salmon: "#FA8072",
            sandybrown: "#F4A460",
            seagreen: "#2E8B57",
            seashell: "#FFF5EE",
            sienna: "#A0522D",
            skyblue: "#87CEEB",
            slateblue: "#6A5ACD",
            slategray: "#708090",
            slategrey: "#708090",
            snow: "#FFFAFA",
            springgreen: "#00FF7F",
            steelblue: "#4682B4",
            tan: "#D2B48C",
            thistle: "#D8BFD8",
            tomato: "#FF6347",
            turquoise: "#40E0D0",
            violet: "#EE82EE",
            wheat: "#F5DEB3",
            whitesmoke: "#F5F5F5",
            yellowgreen: "#9ACD32"
        };

        function g(i) {
            var m = i.indexOf("(", 3);
            var Z = i.indexOf(")", m + 1);
            var j = i.substring(m + 1, Z).split(",");
            if (j.length == 4 && i.substr(3, 1) == "a") {
                alpha = Number(j[3])
            } else {
                j[3] = 1
            }
            return j
        }

        function C(Z) {
            return parseFloat(Z) / 100
        }

        function N(i, j, Z) {
            return Math.min(Z, Math.max(j, i))
        }

        function c(AF) {
            var j, i, Z;
            h = parseFloat(AF[0]) / 360 % 360;
            if (h < 0) {
                h++
            }
            s = N(C(AF[1]), 0, 1);
            l = N(C(AF[2]), 0, 1);
            if (s == 0) {
                j = i = Z = l
            } else {
                var m = l < 0.5 ? l * (1 + s) : l + s - l * s;
                var AE = 2 * l - m;
                j = A(AE, m, h + 1 / 3);
                i = A(AE, m, h);
                Z = A(AE, m, h - 1 / 3)
            }
            return "#" + I[Math.floor(j * 255)] + I[Math.floor(i * 255)] + I[Math.floor(Z * 255)]
        }

        function A(i, Z, j) {
            if (j < 0) {
                j++
            }
            if (j > 1) {
                j--
            }
            if (6 * j < 1) {
                return i + (Z - i) * 6 * j
            } else {
                if (2 * j < 1) {
                    return Z
                } else {
                    if (3 * j < 2) {
                        return i + (Z - i) * (2 / 3 - j) * 6
                    } else {
                        return i
                    }
                }
            }
        }

        function Y(Z) {
            var AE, p = 1;
            Z = String(Z);
            if (Z.charAt(0) == "#") {
                AE = Z
            } else {
                if (/^rgb/.test(Z)) {
                    var m = g(Z);
                    var AE = "#", AF;
                    for (var j = 0; j < 3; j++) {
                        if (m[j].indexOf("%") != -1) {
                            AF = Math.floor(C(m[j]) * 255)
                        } else {
                            AF = Number(m[j])
                        }
                        AE += I[N(AF, 0, 255)]
                    }
                    p = m[3]
                } else {
                    if (/^hsl/.test(Z)) {
                        var m = g(Z);
                        AE = c(m);
                        p = m[3]
                    } else {
                        AE = B[Z] || Z
                    }
                }
            }
            return {color: AE, alpha: p}
        }

        var L = {style: "normal", variant: "normal", weight: "normal", size: 10, family: "sans-serif"};
        var f = {};

        function X(Z) {
            if (f[Z]) {
                return f[Z]
            }
            var m = document.createElement("div");
            var j = m.style;
            try {
                j.font = Z
            } catch (i) {
            }
            return f[Z] = {
                style: j.fontStyle || L.style,
                variant: j.fontVariant || L.variant,
                weight: j.fontWeight || L.weight,
                size: j.fontSize || L.size,
                family: j.fontFamily || L.family
            }
        }

        function P(j, i) {
            var Z = {};
            for (var AF in j) {
                Z[AF] = j[AF]
            }
            var AE = parseFloat(i.currentStyle.fontSize), m = parseFloat(j.size);
            if (typeof j.size == "number") {
                Z.size = j.size
            } else {
                if (j.size.indexOf("px") != -1) {
                    Z.size = m
                } else {
                    if (j.size.indexOf("em") != -1) {
                        Z.size = AE * m
                    } else {
                        if (j.size.indexOf("%") != -1) {
                            Z.size = (AE / 100) * m
                        } else {
                            if (j.size.indexOf("pt") != -1) {
                                Z.size = m / 0.75
                            } else {
                                Z.size = AE
                            }
                        }
                    }
                }
            }
            Z.size *= 0.981;
            return Z
        }

        function AA(Z) {
            return Z.style + " " + Z.variant + " " + Z.weight + " " + Z.size + "px " + Z.family
        }

        function t(Z) {
            switch (Z) {
                case"butt":
                    return "flat";
                case"round":
                    return "round";
                case"square":
                default:
                    return "square"
            }
        }

        function W(i) {
            this.m_ = V();
            this.mStack_ = [];
            this.aStack_ = [];
            this.currentPath_ = [];
            this.strokeStyle = "#000";
            this.fillStyle = "#000";
            this.lineWidth = 1;
            this.lineJoin = "miter";
            this.lineCap = "butt";
            this.miterLimit = D * 1;
            this.globalAlpha = 1;
            this.font = "10px sans-serif";
            this.textAlign = "left";
            this.textBaseline = "alphabetic";
            this.canvas = i;
            var Z = i.ownerDocument.createElement("div");
            Z.style.width = i.clientWidth + "px";
            Z.style.height = i.clientHeight + "px";
            Z.style.overflow = "hidden";
            Z.style.position = "absolute";
            i.appendChild(Z);
            this.element_ = Z;
            this.arcScaleX_ = 1;
            this.arcScaleY_ = 1;
            this.lineScale_ = 1
        }

        var M = W.prototype;
        M.clearRect = function () {
            if (this.textMeasureEl_) {
                this.textMeasureEl_.removeNode(true);
                this.textMeasureEl_ = null
            }
            this.element_.innerHTML = ""
        };
        M.beginPath = function () {
            this.currentPath_ = []
        };
        M.moveTo = function (i, Z) {
            var j = this.getCoords_(i, Z);
            this.currentPath_.push({type: "moveTo", x: j.x, y: j.y});
            this.currentX_ = j.x;
            this.currentY_ = j.y
        };
        M.lineTo = function (i, Z) {
            var j = this.getCoords_(i, Z);
            this.currentPath_.push({type: "lineTo", x: j.x, y: j.y});
            this.currentX_ = j.x;
            this.currentY_ = j.y
        };
        M.bezierCurveTo = function (j, i, AI, AH, AG, AE) {
            var Z = this.getCoords_(AG, AE);
            var AF = this.getCoords_(j, i);
            var m = this.getCoords_(AI, AH);
            e(this, AF, m, Z)
        };
        function e(Z, m, j, i) {
            Z.currentPath_.push({type: "bezierCurveTo", cp1x: m.x, cp1y: m.y, cp2x: j.x, cp2y: j.y, x: i.x, y: i.y});
            Z.currentX_ = i.x;
            Z.currentY_ = i.y
        }

        M.quadraticCurveTo = function (AG, j, i, Z) {
            var AF = this.getCoords_(AG, j);
            var AE = this.getCoords_(i, Z);
            var AH = {
                x: this.currentX_ + 2 / 3 * (AF.x - this.currentX_),
                y: this.currentY_ + 2 / 3 * (AF.y - this.currentY_)
            };
            var m = {x: AH.x + (AE.x - this.currentX_) / 3, y: AH.y + (AE.y - this.currentY_) / 3};
            e(this, AH, m, AE)
        };
        M.arc = function (AJ, AH, AI, AE, i, j) {
            AI *= D;
            var AN = j ? "at" : "wa";
            var AK = AJ + U(AE) * AI - F;
            var AM = AH + J(AE) * AI - F;
            var Z = AJ + U(i) * AI - F;
            var AL = AH + J(i) * AI - F;
            if (AK == Z && !j) {
                AK += 0.125
            }
            var m = this.getCoords_(AJ, AH);
            var AG = this.getCoords_(AK, AM);
            var AF = this.getCoords_(Z, AL);
            this.currentPath_.push({
                type: AN,
                x: m.x,
                y: m.y,
                radius: AI,
                xStart: AG.x,
                yStart: AG.y,
                xEnd: AF.x,
                yEnd: AF.y
            })
        };
        M.rect = function (j, i, Z, m) {
            this.moveTo(j, i);
            this.lineTo(j + Z, i);
            this.lineTo(j + Z, i + m);
            this.lineTo(j, i + m);
            this.closePath()
        };
        M.strokeRect = function (j, i, Z, m) {
            var p = this.currentPath_;
            this.beginPath();
            this.moveTo(j, i);
            this.lineTo(j + Z, i);
            this.lineTo(j + Z, i + m);
            this.lineTo(j, i + m);
            this.closePath();
            this.stroke();
            this.currentPath_ = p
        };
        M.fillRect = function (j, i, Z, m) {
            var p = this.currentPath_;
            this.beginPath();
            this.moveTo(j, i);
            this.lineTo(j + Z, i);
            this.lineTo(j + Z, i + m);
            this.lineTo(j, i + m);
            this.closePath();
            this.fill();
            this.currentPath_ = p
        };
        M.createLinearGradient = function (i, m, Z, j) {
            var p = new v("gradient");
            p.x0_ = i;
            p.y0_ = m;
            p.x1_ = Z;
            p.y1_ = j;
            return p
        };
        M.createRadialGradient = function (m, AE, j, i, p, Z) {
            var AF = new v("gradientradial");
            AF.x0_ = m;
            AF.y0_ = AE;
            AF.r0_ = j;
            AF.x1_ = i;
            AF.y1_ = p;
            AF.r1_ = Z;
            return AF
        };
        M.drawImage = function (AO, j) {
            var AH, AF, AJ, AV, AM, AK, AQ, AX;
            var AI = AO.runtimeStyle.width;
            var AN = AO.runtimeStyle.height;
            AO.runtimeStyle.width = "auto";
            AO.runtimeStyle.height = "auto";
            var AG = AO.width;
            var AT = AO.height;
            AO.runtimeStyle.width = AI;
            AO.runtimeStyle.height = AN;
            if (arguments.length == 3) {
                AH = arguments[1];
                AF = arguments[2];
                AM = AK = 0;
                AQ = AJ = AG;
                AX = AV = AT
            } else {
                if (arguments.length == 5) {
                    AH = arguments[1];
                    AF = arguments[2];
                    AJ = arguments[3];
                    AV = arguments[4];
                    AM = AK = 0;
                    AQ = AG;
                    AX = AT
                } else {
                    if (arguments.length == 9) {
                        AM = arguments[1];
                        AK = arguments[2];
                        AQ = arguments[3];
                        AX = arguments[4];
                        AH = arguments[5];
                        AF = arguments[6];
                        AJ = arguments[7];
                        AV = arguments[8]
                    } else {
                        throw Error("Invalid number of arguments")
                    }
                }
            }
            var AW = this.getCoords_(AH, AF);
            var m = AQ / 2;
            var i = AX / 2;
            var AU = [];
            var Z = 10;
            var AE = 10;
            AU.push(" <g_vml_:group", ' coordsize="', D * Z, ",", D * AE, '"', ' coordorigin="0,0"', ' style="width:', Z, "px;height:", AE, "px;position:absolute;");
            if (this.m_[0][0] != 1 || this.m_[0][1] || this.m_[1][1] != 1 || this.m_[1][0]) {
                var p = [];
                p.push("M11=", this.m_[0][0], ",", "M12=", this.m_[1][0], ",", "M21=", this.m_[0][1], ",", "M22=", this.m_[1][1], ",", "Dx=", K(AW.x / D), ",", "Dy=", K(AW.y / D), "");
                var AS = AW;
                var AR = this.getCoords_(AH + AJ, AF);
                var AP = this.getCoords_(AH, AF + AV);
                var AL = this.getCoords_(AH + AJ, AF + AV);
                AS.x = z.max(AS.x, AR.x, AP.x, AL.x);
                AS.y = z.max(AS.y, AR.y, AP.y, AL.y);
                AU.push("padding:0 ", K(AS.x / D), "px ", K(AS.y / D), "px 0;filter:progid:DXImageTransform.Microsoft.Matrix(", p.join(""), ", sizingmethod='clip');")
            } else {
                AU.push("top:", K(AW.y / D), "px;left:", K(AW.x / D), "px;")
            }
            AU.push(' ">', '<g_vml_:image src="', AO.src, '"', ' style="width:', D * AJ, "px;", " height:", D * AV, 'px"', ' cropleft="', AM / AG, '"', ' croptop="', AK / AT, '"', ' cropright="', (AG - AM - AQ) / AG, '"', ' cropbottom="', (AT - AK - AX) / AT, '"', " />", "</g_vml_:group>");
            this.element_.insertAdjacentHTML("BeforeEnd", AU.join(""))
        };
        M.stroke = function (AM) {
            var m = 10;
            var AN = 10;
            var AE = 5000;
            var AG = {x: null, y: null};
            var AL = {x: null, y: null};
            for (var AH = 0; AH < this.currentPath_.length; AH += AE) {
                var AK = [];
                var AF = false;
                AK.push("<g_vml_:shape", ' filled="', !!AM, '"', ' style="position:absolute;width:', m, "px;height:", AN, 'px;"', ' coordorigin="0,0"', ' coordsize="', D * m, ",", D * AN, '"', ' stroked="', !AM, '"', ' path="');
                var AO = false;
                for (var AI = AH; AI < Math.min(AH + AE, this.currentPath_.length); AI++) {
                    if (AI % AE == 0 && AI > 0) {
                        AK.push(" m ", K(this.currentPath_[AI - 1].x), ",", K(this.currentPath_[AI - 1].y))
                    }
                    var Z = this.currentPath_[AI];
                    var AJ;
                    switch (Z.type) {
                        case"moveTo":
                            AJ = Z;
                            AK.push(" m ", K(Z.x), ",", K(Z.y));
                            break;
                        case"lineTo":
                            AK.push(" l ", K(Z.x), ",", K(Z.y));
                            break;
                        case"close":
                            AK.push(" x ");
                            Z = null;
                            break;
                        case"bezierCurveTo":
                            AK.push(" c ", K(Z.cp1x), ",", K(Z.cp1y), ",", K(Z.cp2x), ",", K(Z.cp2y), ",", K(Z.x), ",", K(Z.y));
                            break;
                        case"at":
                        case"wa":
                            AK.push(" ", Z.type, " ", K(Z.x - this.arcScaleX_ * Z.radius), ",", K(Z.y - this.arcScaleY_ * Z.radius), " ", K(Z.x + this.arcScaleX_ * Z.radius), ",", K(Z.y + this.arcScaleY_ * Z.radius), " ", K(Z.xStart), ",", K(Z.yStart), " ", K(Z.xEnd), ",", K(Z.yEnd));
                            break
                    }
                    if (Z) {
                        if (AG.x == null || Z.x < AG.x) {
                            AG.x = Z.x
                        }
                        if (AL.x == null || Z.x > AL.x) {
                            AL.x = Z.x
                        }
                        if (AG.y == null || Z.y < AG.y) {
                            AG.y = Z.y
                        }
                        if (AL.y == null || Z.y > AL.y) {
                            AL.y = Z.y
                        }
                    }
                }
                AK.push(' ">');
                if (!AM) {
                    R(this, AK)
                } else {
                    a(this, AK, AG, AL)
                }
                AK.push("</g_vml_:shape>");
                this.element_.insertAdjacentHTML("beforeEnd", AK.join(""))
            }
        };
        function R(j, AE) {
            var i = Y(j.strokeStyle);
            var m = i.color;
            var p = i.alpha * j.globalAlpha;
            var Z = j.lineScale_ * j.lineWidth;
            if (Z < 1) {
                p *= Z
            }
            AE.push("<g_vml_:stroke", ' opacity="', p, '"', ' joinstyle="', j.lineJoin, '"', ' miterlimit="', j.miterLimit, '"', ' endcap="', t(j.lineCap), '"', ' weight="', Z, 'px"', ' color="', m, '" />')
        }

        function a(AO, AG, Ah, AP) {
            var AH = AO.fillStyle;
            var AY = AO.arcScaleX_;
            var AX = AO.arcScaleY_;
            var Z = AP.x - Ah.x;
            var m = AP.y - Ah.y;
            if (AH instanceof v) {
                var AL = 0;
                var Ac = {x: 0, y: 0};
                var AU = 0;
                var AK = 1;
                if (AH.type_ == "gradient") {
                    var AJ = AH.x0_ / AY;
                    var j = AH.y0_ / AX;
                    var AI = AH.x1_ / AY;
                    var Aj = AH.y1_ / AX;
                    var Ag = AO.getCoords_(AJ, j);
                    var Af = AO.getCoords_(AI, Aj);
                    var AE = Af.x - Ag.x;
                    var p = Af.y - Ag.y;
                    AL = Math.atan2(AE, p) * 180 / Math.PI;
                    if (AL < 0) {
                        AL += 360
                    }
                    if (AL < 0.000001) {
                        AL = 0
                    }
                } else {
                    var Ag = AO.getCoords_(AH.x0_, AH.y0_);
                    Ac = {x: (Ag.x - Ah.x) / Z, y: (Ag.y - Ah.y) / m};
                    Z /= AY * D;
                    m /= AX * D;
                    var Aa = z.max(Z, m);
                    AU = 2 * AH.r0_ / Aa;
                    AK = 2 * AH.r1_ / Aa - AU
                }
                var AS = AH.colors_;
                AS.sort(function (Ak, i) {
                    return Ak.offset - i.offset
                });
                var AN = AS.length;
                var AR = AS[0].color;
                var AQ = AS[AN - 1].color;
                var AW = AS[0].alpha * AO.globalAlpha;
                var AV = AS[AN - 1].alpha * AO.globalAlpha;
                var Ab = [];
                for (var Ae = 0; Ae < AN; Ae++) {
                    var AM = AS[Ae];
                    Ab.push(AM.offset * AK + AU + " " + AM.color)
                }
                AG.push('<g_vml_:fill type="', AH.type_, '"', ' method="none" focus="100%"', ' color="', AR, '"', ' color2="', AQ, '"', ' colors="', Ab.join(","), '"', ' opacity="', AV, '"', ' g_o_:opacity2="', AW, '"', ' angle="', AL, '"', ' focusposition="', Ac.x, ",", Ac.y, '" />')
            } else {
                if (AH instanceof u) {
                    if (Z && m) {
                        var AF = -Ah.x;
                        var AZ = -Ah.y;
                        AG.push("<g_vml_:fill", ' position="', AF / Z * AY * AY, ",", AZ / m * AX * AX, '"', ' type="tile"', ' src="', AH.src_, '" />')
                    }
                } else {
                    var Ai = Y(AO.fillStyle);
                    var AT = Ai.color;
                    var Ad = Ai.alpha * AO.globalAlpha;
                    AG.push('<g_vml_:fill color="', AT, '" opacity="', Ad, '" />')
                }
            }
        }

        M.fill = function () {
            this.stroke(true)
        };
        M.closePath = function () {
            this.currentPath_.push({type: "close"})
        };
        M.getCoords_ = function (j, i) {
            var Z = this.m_;
            return {x: D * (j * Z[0][0] + i * Z[1][0] + Z[2][0]) - F, y: D * (j * Z[0][1] + i * Z[1][1] + Z[2][1]) - F}
        };
        M.save = function () {
            var Z = {};
            Q(this, Z);
            this.aStack_.push(Z);
            this.mStack_.push(this.m_);
            this.m_ = d(V(), this.m_)
        };
        M.restore = function () {
            if (this.aStack_.length) {
                Q(this.aStack_.pop(), this);
                this.m_ = this.mStack_.pop()
            }
        };
        function H(Z) {
            return isFinite(Z[0][0]) && isFinite(Z[0][1]) && isFinite(Z[1][0]) && isFinite(Z[1][1]) && isFinite(Z[2][0]) && isFinite(Z[2][1])
        }

        function y(i, Z, j) {
            if (!H(Z)) {
                return
            }
            i.m_ = Z;
            if (j) {
                var p = Z[0][0] * Z[1][1] - Z[0][1] * Z[1][0];
                i.lineScale_ = k(b(p))
            }
        }

        M.translate = function (j, i) {
            var Z = [[1, 0, 0], [0, 1, 0], [j, i, 1]];
            y(this, d(Z, this.m_), false)
        };
        M.rotate = function (i) {
            var m = U(i);
            var j = J(i);
            var Z = [[m, j, 0], [-j, m, 0], [0, 0, 1]];
            y(this, d(Z, this.m_), false)
        };
        M.scale = function (j, i) {
            this.arcScaleX_ *= j;
            this.arcScaleY_ *= i;
            var Z = [[j, 0, 0], [0, i, 0], [0, 0, 1]];
            y(this, d(Z, this.m_), true)
        };
        M.transform = function (p, m, AF, AE, i, Z) {
            var j = [[p, m, 0], [AF, AE, 0], [i, Z, 1]];
            y(this, d(j, this.m_), true)
        };
        M.setTransform = function (AE, p, AG, AF, j, i) {
            var Z = [[AE, p, 0], [AG, AF, 0], [j, i, 1]];
            y(this, Z, true)
        };
        M.drawText_ = function (AK, AI, AH, AN, AG) {
            var AM = this.m_, AQ = 1000, i = 0, AP = AQ, AF = {x: 0, y: 0}, AE = [];
            var Z = P(X(this.font), this.element_);
            var j = AA(Z);
            var AR = this.element_.currentStyle;
            var p = this.textAlign.toLowerCase();
            switch (p) {
                case"left":
                case"center":
                case"right":
                    break;
                case"end":
                    p = AR.direction == "ltr" ? "right" : "left";
                    break;
                case"start":
                    p = AR.direction == "rtl" ? "right" : "left";
                    break;
                default:
                    p = "left"
            }
            switch (this.textBaseline) {
                case"hanging":
                case"top":
                    AF.y = Z.size / 1.75;
                    break;
                case"middle":
                    break;
                default:
                case null:
                case"alphabetic":
                case"ideographic":
                case"bottom":
                    AF.y = -Z.size / 2.25;
                    break
            }
            switch (p) {
                case"right":
                    i = AQ;
                    AP = 0.05;
                    break;
                case"center":
                    i = AP = AQ / 2;
                    break
            }
            var AO = this.getCoords_(AI + AF.x, AH + AF.y);
            AE.push('<g_vml_:line from="', -i, ' 0" to="', AP, ' 0.05" ', ' coordsize="100 100" coordorigin="0 0"', ' filled="', !AG, '" stroked="', !!AG, '" style="position:absolute;width:1px;height:1px;">');
            if (AG) {
                R(this, AE)
            } else {
                a(this, AE, {x: -i, y: 0}, {x: AP, y: Z.size})
            }
            var AL = AM[0][0].toFixed(3) + "," + AM[1][0].toFixed(3) + "," + AM[0][1].toFixed(3) + "," + AM[1][1].toFixed(3) + ",0,0";
            var AJ = K(AO.x / D) + "," + K(AO.y / D);
            AE.push('<g_vml_:skew on="t" matrix="', AL, '" ', ' offset="', AJ, '" origin="', i, ' 0" />', '<g_vml_:path textpathok="true" />', '<g_vml_:textpath on="true" string="', AD(AK), '" style="v-text-align:', p, ";font:", AD(j), '" /></g_vml_:line>');
            this.element_.insertAdjacentHTML("beforeEnd", AE.join(""))
        };
        M.fillText = function (j, Z, m, i) {
            this.drawText_(j, Z, m, i, false)
        };
        M.strokeText = function (j, Z, m, i) {
            this.drawText_(j, Z, m, i, true)
        };
        M.measureText = function (j) {
            if (!this.textMeasureEl_) {
                var Z = '<span style="position:absolute;top:-20000px;left:0;padding:0;margin:0;border:none;white-space:pre;"></span>';
                this.element_.insertAdjacentHTML("beforeEnd", Z);
                this.textMeasureEl_ = this.element_.lastChild
            }
            var i = this.element_.ownerDocument;
            this.textMeasureEl_.innerHTML = "";
            this.textMeasureEl_.style.font = this.font;
            this.textMeasureEl_.appendChild(i.createTextNode(j));
            return {width: this.textMeasureEl_.offsetWidth}
        };
        M.clip = function () {
        };
        M.arcTo = function () {
        };
        M.createPattern = function (i, Z) {
            return new u(i, Z)
        };
        function v(Z) {
            this.type_ = Z;
            this.x0_ = 0;
            this.y0_ = 0;
            this.r0_ = 0;
            this.x1_ = 0;
            this.y1_ = 0;
            this.r1_ = 0;
            this.colors_ = []
        }

        v.prototype.addColorStop = function (i, Z) {
            Z = Y(Z);
            this.colors_.push({offset: i, color: Z.color, alpha: Z.alpha})
        };
        function u(i, Z) {
            q(i);
            switch (Z) {
                case"repeat":
                case null:
                case"":
                    this.repetition_ = "repeat";
                    break;
                case"repeat-x":
                case"repeat-y":
                case"no-repeat":
                    this.repetition_ = Z;
                    break;
                default:
                    n("SYNTAX_ERR")
            }
            this.src_ = i.src;
            this.width_ = i.width;
            this.height_ = i.height
        }

        function n(Z) {
            throw new o(Z)
        }

        function q(Z) {
            if (!Z || Z.nodeType != 1 || Z.tagName != "IMG") {
                n("TYPE_MISMATCH_ERR")
            }
            if (Z.readyState != "complete") {
                n("INVALID_STATE_ERR")
            }
        }

        function o(Z) {
            this.code = this[Z];
            this.message = Z + ": DOM Exception " + this.code
        }

        var x = o.prototype = new Error;
        x.INDEX_SIZE_ERR = 1;
        x.DOMSTRING_SIZE_ERR = 2;
        x.HIERARCHY_REQUEST_ERR = 3;
        x.WRONG_DOCUMENT_ERR = 4;
        x.INVALID_CHARACTER_ERR = 5;
        x.NO_DATA_ALLOWED_ERR = 6;
        x.NO_MODIFICATION_ALLOWED_ERR = 7;
        x.NOT_FOUND_ERR = 8;
        x.NOT_SUPPORTED_ERR = 9;
        x.INUSE_ATTRIBUTE_ERR = 10;
        x.INVALID_STATE_ERR = 11;
        x.SYNTAX_ERR = 12;
        x.INVALID_MODIFICATION_ERR = 13;
        x.NAMESPACE_ERR = 14;
        x.INVALID_ACCESS_ERR = 15;
        x.VALIDATION_ERR = 16;
        x.TYPE_MISMATCH_ERR = 17;
        G_vmlCanvasManager = E;
        CanvasRenderingContext2D = W;
        CanvasGradient = v;
        CanvasPattern = u;
        DOMException = o
    })()
}
;
// Flot Charts sample data for SB Admin template

// Flot Line Chart with Tooltips
$(document).ready(function () {
    console.log("document ready");
    var offset = 0;
    plot();

    function plot() {
        var sin = [],
            cos = [];
        for (var i = 0; i < 12; i += 0.2) {
            sin.push([i, Math.sin(i + offset)]);
            cos.push([i, Math.cos(i + offset)]);
        }

        var options = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true //IMPORTANT! this is needed for tooltip to work
            },
            yaxis: {
                min: -1.2,
                max: 1.2
            },
            tooltip: true,
            tooltipOpts: {
                content: "'%s' of %x.1 is %y.4",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        };

        var plotObj = $.plot($("#flot-line-chart"), [{
                data: sin,
                label: "sin(x)"
            }, {
                data: cos,
                label: "cos(x)"
            }],
            options);
    }
});

// Flot Pie Chart with Tooltips
$(function () {

    var data = [{
        label: "Series 0",
        data: 1
    }, {
        label: "Series 1",
        data: 3
    }, {
        label: "Series 2",
        data: 9
    }, {
        label: "Series 3",
        data: 20
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});

// Flot Line Charts - Multiple Axes - With Data
$(function () {
    var oilprices = [
        [1167692400000, 61.05],
        [1167778800000, 58.32],
        [1167865200000, 57.35],
        [1167951600000, 56.31],
        [1168210800000, 55.55],
        [1168297200000, 55.64],
        [1168383600000, 54.02],
        [1168470000000, 51.88],
        [1168556400000, 52.99],
        [1168815600000, 52.99],
        [1168902000000, 51.21],
        [1168988400000, 52.24],
        [1169074800000, 50.48],
        [1169161200000, 51.99],
        [1169420400000, 51.13],
        [1169506800000, 55.04],
        [1169593200000, 55.37],
        [1169679600000, 54.23],
        [1169766000000, 55.42],
        [1170025200000, 54.01],
        [1170111600000, 56.97],
        [1170198000000, 58.14],
        [1170284400000, 58.14],
        [1170370800000, 59.02],
        [1170630000000, 58.74],
        [1170716400000, 58.88],
        [1170802800000, 57.71],
        [1170889200000, 59.71],
        [1170975600000, 59.89],
        [1171234800000, 57.81],
        [1171321200000, 59.06],
        [1171407600000, 58.00],
        [1171494000000, 57.99],
        [1171580400000, 59.39],
        [1171839600000, 59.39],
        [1171926000000, 58.07],
        [1172012400000, 60.07],
        [1172098800000, 61.14],
        [1172444400000, 61.39],
        [1172530800000, 61.46],
        [1172617200000, 61.79],
        [1172703600000, 62.00],
        [1172790000000, 60.07],
        [1173135600000, 60.69],
        [1173222000000, 61.82],
        [1173308400000, 60.05],
        [1173654000000, 58.91],
        [1173740400000, 57.93],
        [1173826800000, 58.16],
        [1173913200000, 57.55],
        [1173999600000, 57.11],
        [1174258800000, 56.59],
        [1174345200000, 59.61],
        [1174518000000, 61.69],
        [1174604400000, 62.28],
        [1174860000000, 62.91],
        [1174946400000, 62.93],
        [1175032800000, 64.03],
        [1175119200000, 66.03],
        [1175205600000, 65.87],
        [1175464800000, 64.64],
        [1175637600000, 64.38],
        [1175724000000, 64.28],
        [1175810400000, 64.28],
        [1176069600000, 61.51],
        [1176156000000, 61.89],
        [1176242400000, 62.01],
        [1176328800000, 63.85],
        [1176415200000, 63.63],
        [1176674400000, 63.61],
        [1176760800000, 63.10],
        [1176847200000, 63.13],
        [1176933600000, 61.83],
        [1177020000000, 63.38],
        [1177279200000, 64.58],
        [1177452000000, 65.84],
        [1177538400000, 65.06],
        [1177624800000, 66.46],
        [1177884000000, 64.40],
        [1178056800000, 63.68],
        [1178143200000, 63.19],
        [1178229600000, 61.93],
        [1178488800000, 61.47],
        [1178575200000, 61.55],
        [1178748000000, 61.81],
        [1178834400000, 62.37],
        [1179093600000, 62.46],
        [1179180000000, 63.17],
        [1179266400000, 62.55],
        [1179352800000, 64.94],
        [1179698400000, 66.27],
        [1179784800000, 65.50],
        [1179871200000, 65.77],
        [1179957600000, 64.18],
        [1180044000000, 65.20],
        [1180389600000, 63.15],
        [1180476000000, 63.49],
        [1180562400000, 65.08],
        [1180908000000, 66.30],
        [1180994400000, 65.96],
        [1181167200000, 66.93],
        [1181253600000, 65.98],
        [1181599200000, 65.35],
        [1181685600000, 66.26],
        [1181858400000, 68.00],
        [1182117600000, 69.09],
        [1182204000000, 69.10],
        [1182290400000, 68.19],
        [1182376800000, 68.19],
        [1182463200000, 69.14],
        [1182722400000, 68.19],
        [1182808800000, 67.77],
        [1182895200000, 68.97],
        [1182981600000, 69.57],
        [1183068000000, 70.68],
        [1183327200000, 71.09],
        [1183413600000, 70.92],
        [1183586400000, 71.81],
        [1183672800000, 72.81],
        [1183932000000, 72.19],
        [1184018400000, 72.56],
        [1184191200000, 72.50],
        [1184277600000, 74.15],
        [1184623200000, 75.05],
        [1184796000000, 75.92],
        [1184882400000, 75.57],
        [1185141600000, 74.89],
        [1185228000000, 73.56],
        [1185314400000, 75.57],
        [1185400800000, 74.95],
        [1185487200000, 76.83],
        [1185832800000, 78.21],
        [1185919200000, 76.53],
        [1186005600000, 76.86],
        [1186092000000, 76.00],
        [1186437600000, 71.59],
        [1186696800000, 71.47],
        [1186956000000, 71.62],
        [1187042400000, 71.00],
        [1187301600000, 71.98],
        [1187560800000, 71.12],
        [1187647200000, 69.47],
        [1187733600000, 69.26],
        [1187820000000, 69.83],
        [1187906400000, 71.09],
        [1188165600000, 71.73],
        [1188338400000, 73.36],
        [1188511200000, 74.04],
        [1188856800000, 76.30],
        [1189116000000, 77.49],
        [1189461600000, 78.23],
        [1189548000000, 79.91],
        [1189634400000, 80.09],
        [1189720800000, 79.10],
        [1189980000000, 80.57],
        [1190066400000, 81.93],
        [1190239200000, 83.32],
        [1190325600000, 81.62],
        [1190584800000, 80.95],
        [1190671200000, 79.53],
        [1190757600000, 80.30],
        [1190844000000, 82.88],
        [1190930400000, 81.66],
        [1191189600000, 80.24],
        [1191276000000, 80.05],
        [1191362400000, 79.94],
        [1191448800000, 81.44],
        [1191535200000, 81.22],
        [1191794400000, 79.02],
        [1191880800000, 80.26],
        [1191967200000, 80.30],
        [1192053600000, 83.08],
        [1192140000000, 83.69],
        [1192399200000, 86.13],
        [1192485600000, 87.61],
        [1192572000000, 87.40],
        [1192658400000, 89.47],
        [1192744800000, 88.60],
        [1193004000000, 87.56],
        [1193090400000, 87.56],
        [1193176800000, 87.10],
        [1193263200000, 91.86],
        [1193612400000, 93.53],
        [1193698800000, 94.53],
        [1193871600000, 95.93],
        [1194217200000, 93.98],
        [1194303600000, 96.37],
        [1194476400000, 95.46],
        [1194562800000, 96.32],
        [1195081200000, 93.43],
        [1195167600000, 95.10],
        [1195426800000, 94.64],
        [1195513200000, 95.10],
        [1196031600000, 97.70],
        [1196118000000, 94.42],
        [1196204400000, 90.62],
        [1196290800000, 91.01],
        [1196377200000, 88.71],
        [1196636400000, 88.32],
        [1196809200000, 90.23],
        [1196982000000, 88.28],
        [1197241200000, 87.86],
        [1197327600000, 90.02],
        [1197414000000, 92.25],
        [1197586800000, 90.63],
        [1197846000000, 90.63],
        [1197932400000, 90.49],
        [1198018800000, 91.24],
        [1198105200000, 91.06],
        [1198191600000, 90.49],
        [1198710000000, 96.62],
        [1198796400000, 96.00],
        [1199142000000, 99.62],
        [1199314800000, 99.18],
        [1199401200000, 95.09],
        [1199660400000, 96.33],
        [1199833200000, 95.67],
        [1200351600000, 91.90],
        [1200438000000, 90.84],
        [1200524400000, 90.13],
        [1200610800000, 90.57],
        [1200956400000, 89.21],
        [1201042800000, 86.99],
        [1201129200000, 89.85],
        [1201474800000, 90.99],
        [1201561200000, 91.64],
        [1201647600000, 92.33],
        [1201734000000, 91.75],
        [1202079600000, 90.02],
        [1202166000000, 88.41],
        [1202252400000, 87.14],
        [1202338800000, 88.11],
        [1202425200000, 91.77],
        [1202770800000, 92.78],
        [1202857200000, 93.27],
        [1202943600000, 95.46],
        [1203030000000, 95.46],
        [1203289200000, 101.74],
        [1203462000000, 98.81],
        [1203894000000, 100.88],
        [1204066800000, 99.64],
        [1204153200000, 102.59],
        [1204239600000, 101.84],
        [1204498800000, 99.52],
        [1204585200000, 99.52],
        [1204671600000, 104.52],
        [1204758000000, 105.47],
        [1204844400000, 105.15],
        [1205103600000, 108.75],
        [1205276400000, 109.92],
        [1205362800000, 110.33],
        [1205449200000, 110.21],
        [1205708400000, 105.68],
        [1205967600000, 101.84],
        [1206313200000, 100.86],
        [1206399600000, 101.22],
        [1206486000000, 105.90],
        [1206572400000, 107.58],
        [1206658800000, 105.62],
        [1206914400000, 101.58],
        [1207000800000, 100.98],
        [1207173600000, 103.83],
        [1207260000000, 106.23],
        [1207605600000, 108.50],
        [1207778400000, 110.11],
        [1207864800000, 110.14],
        [1208210400000, 113.79],
        [1208296800000, 114.93],
        [1208383200000, 114.86],
        [1208728800000, 117.48],
        [1208815200000, 118.30],
        [1208988000000, 116.06],
        [1209074400000, 118.52],
        [1209333600000, 118.75],
        [1209420000000, 113.46],
        [1209592800000, 112.52],
        [1210024800000, 121.84],
        [1210111200000, 123.53],
        [1210197600000, 123.69],
        [1210543200000, 124.23],
        [1210629600000, 125.80],
        [1210716000000, 126.29],
        [1211148000000, 127.05],
        [1211320800000, 129.07],
        [1211493600000, 132.19],
        [1211839200000, 128.85],
        [1212357600000, 127.76],
        [1212703200000, 138.54],
        [1212962400000, 136.80],
        [1213135200000, 136.38],
        [1213308000000, 134.86],
        [1213653600000, 134.01],
        [1213740000000, 136.68],
        [1213912800000, 135.65],
        [1214172000000, 134.62],
        [1214258400000, 134.62],
        [1214344800000, 134.62],
        [1214431200000, 139.64],
        [1214517600000, 140.21],
        [1214776800000, 140.00],
        [1214863200000, 140.97],
        [1214949600000, 143.57],
        [1215036000000, 145.29],
        [1215381600000, 141.37],
        [1215468000000, 136.04],
        [1215727200000, 146.40],
        [1215986400000, 145.18],
        [1216072800000, 138.74],
        [1216159200000, 134.60],
        [1216245600000, 129.29],
        [1216332000000, 130.65],
        [1216677600000, 127.95],
        [1216850400000, 127.95],
        [1217282400000, 122.19],
        [1217455200000, 124.08],
        [1217541600000, 125.10],
        [1217800800000, 121.41],
        [1217887200000, 119.17],
        [1217973600000, 118.58],
        [1218060000000, 120.02],
        [1218405600000, 114.45],
        [1218492000000, 113.01],
        [1218578400000, 116.00],
        [1218751200000, 113.77],
        [1219010400000, 112.87],
        [1219096800000, 114.53],
        [1219269600000, 114.98],
        [1219356000000, 114.98],
        [1219701600000, 116.27],
        [1219788000000, 118.15],
        [1219874400000, 115.59],
        [1219960800000, 115.46],
        [1220306400000, 109.71],
        [1220392800000, 109.35],
        [1220565600000, 106.23],
        [1220824800000, 106.34]
    ];
    var exchangerates = [
        [1167606000000, 0.7580],
        [1167692400000, 0.7580],
        [1167778800000, 0.75470],
        [1167865200000, 0.75490],
        [1167951600000, 0.76130],
        [1168038000000, 0.76550],
        [1168124400000, 0.76930],
        [1168210800000, 0.76940],
        [1168297200000, 0.76880],
        [1168383600000, 0.76780],
        [1168470000000, 0.77080],
        [1168556400000, 0.77270],
        [1168642800000, 0.77490],
        [1168729200000, 0.77410],
        [1168815600000, 0.77410],
        [1168902000000, 0.77320],
        [1168988400000, 0.77270],
        [1169074800000, 0.77370],
        [1169161200000, 0.77240],
        [1169247600000, 0.77120],
        [1169334000000, 0.7720],
        [1169420400000, 0.77210],
        [1169506800000, 0.77170],
        [1169593200000, 0.77040],
        [1169679600000, 0.7690],
        [1169766000000, 0.77110],
        [1169852400000, 0.7740],
        [1169938800000, 0.77450],
        [1170025200000, 0.77450],
        [1170111600000, 0.7740],
        [1170198000000, 0.77160],
        [1170284400000, 0.77130],
        [1170370800000, 0.76780],
        [1170457200000, 0.76880],
        [1170543600000, 0.77180],
        [1170630000000, 0.77180],
        [1170716400000, 0.77280],
        [1170802800000, 0.77290],
        [1170889200000, 0.76980],
        [1170975600000, 0.76850],
        [1171062000000, 0.76810],
        [1171148400000, 0.7690],
        [1171234800000, 0.7690],
        [1171321200000, 0.76980],
        [1171407600000, 0.76990],
        [1171494000000, 0.76510],
        [1171580400000, 0.76130],
        [1171666800000, 0.76160],
        [1171753200000, 0.76140],
        [1171839600000, 0.76140],
        [1171926000000, 0.76070],
        [1172012400000, 0.76020],
        [1172098800000, 0.76110],
        [1172185200000, 0.76220],
        [1172271600000, 0.76150],
        [1172358000000, 0.75980],
        [1172444400000, 0.75980],
        [1172530800000, 0.75920],
        [1172617200000, 0.75730],
        [1172703600000, 0.75660],
        [1172790000000, 0.75670],
        [1172876400000, 0.75910],
        [1172962800000, 0.75820],
        [1173049200000, 0.75850],
        [1173135600000, 0.76130],
        [1173222000000, 0.76310],
        [1173308400000, 0.76150],
        [1173394800000, 0.760],
        [1173481200000, 0.76130],
        [1173567600000, 0.76270],
        [1173654000000, 0.76270],
        [1173740400000, 0.76080],
        [1173826800000, 0.75830],
        [1173913200000, 0.75750],
        [1173999600000, 0.75620],
        [1174086000000, 0.7520],
        [1174172400000, 0.75120],
        [1174258800000, 0.75120],
        [1174345200000, 0.75170],
        [1174431600000, 0.7520],
        [1174518000000, 0.75110],
        [1174604400000, 0.7480],
        [1174690800000, 0.75090],
        [1174777200000, 0.75310],
        [1174860000000, 0.75310],
        [1174946400000, 0.75270],
        [1175032800000, 0.74980],
        [1175119200000, 0.74930],
        [1175205600000, 0.75040],
        [1175292000000, 0.750],
        [1175378400000, 0.74910],
        [1175464800000, 0.74910],
        [1175551200000, 0.74850],
        [1175637600000, 0.74840],
        [1175724000000, 0.74920],
        [1175810400000, 0.74710],
        [1175896800000, 0.74590],
        [1175983200000, 0.74770],
        [1176069600000, 0.74770],
        [1176156000000, 0.74830],
        [1176242400000, 0.74580],
        [1176328800000, 0.74480],
        [1176415200000, 0.7430],
        [1176501600000, 0.73990],
        [1176588000000, 0.73950],
        [1176674400000, 0.73950],
        [1176760800000, 0.73780],
        [1176847200000, 0.73820],
        [1176933600000, 0.73620],
        [1177020000000, 0.73550],
        [1177106400000, 0.73480],
        [1177192800000, 0.73610],
        [1177279200000, 0.73610],
        [1177365600000, 0.73650],
        [1177452000000, 0.73620],
        [1177538400000, 0.73310],
        [1177624800000, 0.73390],
        [1177711200000, 0.73440],
        [1177797600000, 0.73270],
        [1177884000000, 0.73270],
        [1177970400000, 0.73360],
        [1178056800000, 0.73330],
        [1178143200000, 0.73590],
        [1178229600000, 0.73590],
        [1178316000000, 0.73720],
        [1178402400000, 0.7360],
        [1178488800000, 0.7360],
        [1178575200000, 0.7350],
        [1178661600000, 0.73650],
        [1178748000000, 0.73840],
        [1178834400000, 0.73950],
        [1178920800000, 0.74130],
        [1179007200000, 0.73970],
        [1179093600000, 0.73960],
        [1179180000000, 0.73850],
        [1179266400000, 0.73780],
        [1179352800000, 0.73660],
        [1179439200000, 0.740],
        [1179525600000, 0.74110],
        [1179612000000, 0.74060],
        [1179698400000, 0.74050],
        [1179784800000, 0.74140],
        [1179871200000, 0.74310],
        [1179957600000, 0.74310],
        [1180044000000, 0.74380],
        [1180130400000, 0.74430],
        [1180216800000, 0.74430],
        [1180303200000, 0.74430],
        [1180389600000, 0.74340],
        [1180476000000, 0.74290],
        [1180562400000, 0.74420],
        [1180648800000, 0.7440],
        [1180735200000, 0.74390],
        [1180821600000, 0.74370],
        [1180908000000, 0.74370],
        [1180994400000, 0.74290],
        [1181080800000, 0.74030],
        [1181167200000, 0.73990],
        [1181253600000, 0.74180],
        [1181340000000, 0.74680],
        [1181426400000, 0.7480],
        [1181512800000, 0.7480],
        [1181599200000, 0.7490],
        [1181685600000, 0.74940],
        [1181772000000, 0.75220],
        [1181858400000, 0.75150],
        [1181944800000, 0.75020],
        [1182031200000, 0.74720],
        [1182117600000, 0.74720],
        [1182204000000, 0.74620],
        [1182290400000, 0.74550],
        [1182376800000, 0.74490],
        [1182463200000, 0.74670],
        [1182549600000, 0.74580],
        [1182636000000, 0.74270],
        [1182722400000, 0.74270],
        [1182808800000, 0.7430],
        [1182895200000, 0.74290],
        [1182981600000, 0.7440],
        [1183068000000, 0.7430],
        [1183154400000, 0.74220],
        [1183240800000, 0.73880],
        [1183327200000, 0.73880],
        [1183413600000, 0.73690],
        [1183500000000, 0.73450],
        [1183586400000, 0.73450],
        [1183672800000, 0.73450],
        [1183759200000, 0.73520],
        [1183845600000, 0.73410],
        [1183932000000, 0.73410],
        [1184018400000, 0.7340],
        [1184104800000, 0.73240],
        [1184191200000, 0.72720],
        [1184277600000, 0.72640],
        [1184364000000, 0.72550],
        [1184450400000, 0.72580],
        [1184536800000, 0.72580],
        [1184623200000, 0.72560],
        [1184709600000, 0.72570],
        [1184796000000, 0.72470],
        [1184882400000, 0.72430],
        [1184968800000, 0.72440],
        [1185055200000, 0.72350],
        [1185141600000, 0.72350],
        [1185228000000, 0.72350],
        [1185314400000, 0.72350],
        [1185400800000, 0.72620],
        [1185487200000, 0.72880],
        [1185573600000, 0.73010],
        [1185660000000, 0.73370],
        [1185746400000, 0.73370],
        [1185832800000, 0.73240],
        [1185919200000, 0.72970],
        [1186005600000, 0.73170],
        [1186092000000, 0.73150],
        [1186178400000, 0.72880],
        [1186264800000, 0.72630],
        [1186351200000, 0.72630],
        [1186437600000, 0.72420],
        [1186524000000, 0.72530],
        [1186610400000, 0.72640],
        [1186696800000, 0.7270],
        [1186783200000, 0.73120],
        [1186869600000, 0.73050],
        [1186956000000, 0.73050],
        [1187042400000, 0.73180],
        [1187128800000, 0.73580],
        [1187215200000, 0.74090],
        [1187301600000, 0.74540],
        [1187388000000, 0.74370],
        [1187474400000, 0.74240],
        [1187560800000, 0.74240],
        [1187647200000, 0.74150],
        [1187733600000, 0.74190],
        [1187820000000, 0.74140],
        [1187906400000, 0.73770],
        [1187992800000, 0.73550],
        [1188079200000, 0.73150],
        [1188165600000, 0.73150],
        [1188252000000, 0.7320],
        [1188338400000, 0.73320],
        [1188424800000, 0.73460],
        [1188511200000, 0.73280],
        [1188597600000, 0.73230],
        [1188684000000, 0.7340],
        [1188770400000, 0.7340],
        [1188856800000, 0.73360],
        [1188943200000, 0.73510],
        [1189029600000, 0.73460],
        [1189116000000, 0.73210],
        [1189202400000, 0.72940],
        [1189288800000, 0.72660],
        [1189375200000, 0.72660],
        [1189461600000, 0.72540],
        [1189548000000, 0.72420],
        [1189634400000, 0.72130],
        [1189720800000, 0.71970],
        [1189807200000, 0.72090],
        [1189893600000, 0.7210],
        [1189980000000, 0.7210],
        [1190066400000, 0.7210],
        [1190152800000, 0.72090],
        [1190239200000, 0.71590],
        [1190325600000, 0.71330],
        [1190412000000, 0.71050],
        [1190498400000, 0.70990],
        [1190584800000, 0.70990],
        [1190671200000, 0.70930],
        [1190757600000, 0.70930],
        [1190844000000, 0.70760],
        [1190930400000, 0.7070],
        [1191016800000, 0.70490],
        [1191103200000, 0.70120],
        [1191189600000, 0.70110],
        [1191276000000, 0.70190],
        [1191362400000, 0.70460],
        [1191448800000, 0.70630],
        [1191535200000, 0.70890],
        [1191621600000, 0.70770],
        [1191708000000, 0.70770],
        [1191794400000, 0.70770],
        [1191880800000, 0.70910],
        [1191967200000, 0.71180],
        [1192053600000, 0.70790],
        [1192140000000, 0.70530],
        [1192226400000, 0.7050],
        [1192312800000, 0.70550],
        [1192399200000, 0.70550],
        [1192485600000, 0.70450],
        [1192572000000, 0.70510],
        [1192658400000, 0.70510],
        [1192744800000, 0.70170],
        [1192831200000, 0.70],
        [1192917600000, 0.69950],
        [1193004000000, 0.69940],
        [1193090400000, 0.70140],
        [1193176800000, 0.70360],
        [1193263200000, 0.70210],
        [1193349600000, 0.70020],
        [1193436000000, 0.69670],
        [1193522400000, 0.6950],
        [1193612400000, 0.6950],
        [1193698800000, 0.69390],
        [1193785200000, 0.6940],
        [1193871600000, 0.69220],
        [1193958000000, 0.69190],
        [1194044400000, 0.69140],
        [1194130800000, 0.68940],
        [1194217200000, 0.68910],
        [1194303600000, 0.69040],
        [1194390000000, 0.6890],
        [1194476400000, 0.68340],
        [1194562800000, 0.68230],
        [1194649200000, 0.68070],
        [1194735600000, 0.68150],
        [1194822000000, 0.68150],
        [1194908400000, 0.68470],
        [1194994800000, 0.68590],
        [1195081200000, 0.68220],
        [1195167600000, 0.68270],
        [1195254000000, 0.68370],
        [1195340400000, 0.68230],
        [1195426800000, 0.68220],
        [1195513200000, 0.68220],
        [1195599600000, 0.67920],
        [1195686000000, 0.67460],
        [1195772400000, 0.67350],
        [1195858800000, 0.67310],
        [1195945200000, 0.67420],
        [1196031600000, 0.67440],
        [1196118000000, 0.67390],
        [1196204400000, 0.67310],
        [1196290800000, 0.67610],
        [1196377200000, 0.67610],
        [1196463600000, 0.67850],
        [1196550000000, 0.68180],
        [1196636400000, 0.68360],
        [1196722800000, 0.68230],
        [1196809200000, 0.68050],
        [1196895600000, 0.67930],
        [1196982000000, 0.68490],
        [1197068400000, 0.68330],
        [1197154800000, 0.68250],
        [1197241200000, 0.68250],
        [1197327600000, 0.68160],
        [1197414000000, 0.67990],
        [1197500400000, 0.68130],
        [1197586800000, 0.68090],
        [1197673200000, 0.68680],
        [1197759600000, 0.69330],
        [1197846000000, 0.69330],
        [1197932400000, 0.69450],
        [1198018800000, 0.69440],
        [1198105200000, 0.69460],
        [1198191600000, 0.69640],
        [1198278000000, 0.69650],
        [1198364400000, 0.69560],
        [1198450800000, 0.69560],
        [1198537200000, 0.6950],
        [1198623600000, 0.69480],
        [1198710000000, 0.69280],
        [1198796400000, 0.68870],
        [1198882800000, 0.68240],
        [1198969200000, 0.67940],
        [1199055600000, 0.67940],
        [1199142000000, 0.68030],
        [1199228400000, 0.68550],
        [1199314800000, 0.68240],
        [1199401200000, 0.67910],
        [1199487600000, 0.67830],
        [1199574000000, 0.67850],
        [1199660400000, 0.67850],
        [1199746800000, 0.67970],
        [1199833200000, 0.680],
        [1199919600000, 0.68030],
        [1200006000000, 0.68050],
        [1200092400000, 0.6760],
        [1200178800000, 0.6770],
        [1200265200000, 0.6770],
        [1200351600000, 0.67360],
        [1200438000000, 0.67260],
        [1200524400000, 0.67640],
        [1200610800000, 0.68210],
        [1200697200000, 0.68310],
        [1200783600000, 0.68420],
        [1200870000000, 0.68420],
        [1200956400000, 0.68870],
        [1201042800000, 0.69030],
        [1201129200000, 0.68480],
        [1201215600000, 0.68240],
        [1201302000000, 0.67880],
        [1201388400000, 0.68140],
        [1201474800000, 0.68140],
        [1201561200000, 0.67970],
        [1201647600000, 0.67690],
        [1201734000000, 0.67650],
        [1201820400000, 0.67330],
        [1201906800000, 0.67290],
        [1201993200000, 0.67580],
        [1202079600000, 0.67580],
        [1202166000000, 0.6750],
        [1202252400000, 0.6780],
        [1202338800000, 0.68330],
        [1202425200000, 0.68560],
        [1202511600000, 0.69030],
        [1202598000000, 0.68960],
        [1202684400000, 0.68960],
        [1202770800000, 0.68820],
        [1202857200000, 0.68790],
        [1202943600000, 0.68620],
        [1203030000000, 0.68520],
        [1203116400000, 0.68230],
        [1203202800000, 0.68130],
        [1203289200000, 0.68130],
        [1203375600000, 0.68220],
        [1203462000000, 0.68020],
        [1203548400000, 0.68020],
        [1203634800000, 0.67840],
        [1203721200000, 0.67480],
        [1203807600000, 0.67470],
        [1203894000000, 0.67470],
        [1203980400000, 0.67480],
        [1204066800000, 0.67330],
        [1204153200000, 0.6650],
        [1204239600000, 0.66110],
        [1204326000000, 0.65830],
        [1204412400000, 0.6590],
        [1204498800000, 0.6590],
        [1204585200000, 0.65810],
        [1204671600000, 0.65780],
        [1204758000000, 0.65740],
        [1204844400000, 0.65320],
        [1204930800000, 0.65020],
        [1205017200000, 0.65140],
        [1205103600000, 0.65140],
        [1205190000000, 0.65070],
        [1205276400000, 0.6510],
        [1205362800000, 0.64890],
        [1205449200000, 0.64240],
        [1205535600000, 0.64060],
        [1205622000000, 0.63820],
        [1205708400000, 0.63820],
        [1205794800000, 0.63410],
        [1205881200000, 0.63440],
        [1205967600000, 0.63780],
        [1206054000000, 0.64390],
        [1206140400000, 0.64780],
        [1206226800000, 0.64810],
        [1206313200000, 0.64810],
        [1206399600000, 0.64940],
        [1206486000000, 0.64380],
        [1206572400000, 0.63770],
        [1206658800000, 0.63290],
        [1206745200000, 0.63360],
        [1206831600000, 0.63330],
        [1206914400000, 0.63330],
        [1207000800000, 0.6330],
        [1207087200000, 0.63710],
        [1207173600000, 0.64030],
        [1207260000000, 0.63960],
        [1207346400000, 0.63640],
        [1207432800000, 0.63560],
        [1207519200000, 0.63560],
        [1207605600000, 0.63680],
        [1207692000000, 0.63570],
        [1207778400000, 0.63540],
        [1207864800000, 0.6320],
        [1207951200000, 0.63320],
        [1208037600000, 0.63280],
        [1208124000000, 0.63310],
        [1208210400000, 0.63420],
        [1208296800000, 0.63210],
        [1208383200000, 0.63020],
        [1208469600000, 0.62780],
        [1208556000000, 0.63080],
        [1208642400000, 0.63240],
        [1208728800000, 0.63240],
        [1208815200000, 0.63070],
        [1208901600000, 0.62770],
        [1208988000000, 0.62690],
        [1209074400000, 0.63350],
        [1209160800000, 0.63920],
        [1209247200000, 0.640],
        [1209333600000, 0.64010],
        [1209420000000, 0.63960],
        [1209506400000, 0.64070],
        [1209592800000, 0.64230],
        [1209679200000, 0.64290],
        [1209765600000, 0.64720],
        [1209852000000, 0.64850],
        [1209938400000, 0.64860],
        [1210024800000, 0.64670],
        [1210111200000, 0.64440],
        [1210197600000, 0.64670],
        [1210284000000, 0.65090],
        [1210370400000, 0.64780],
        [1210456800000, 0.64610],
        [1210543200000, 0.64610],
        [1210629600000, 0.64680],
        [1210716000000, 0.64490],
        [1210802400000, 0.6470],
        [1210888800000, 0.64610],
        [1210975200000, 0.64520],
        [1211061600000, 0.64220],
        [1211148000000, 0.64220],
        [1211234400000, 0.64250],
        [1211320800000, 0.64140],
        [1211407200000, 0.63660],
        [1211493600000, 0.63460],
        [1211580000000, 0.6350],
        [1211666400000, 0.63460],
        [1211752800000, 0.63460],
        [1211839200000, 0.63430],
        [1211925600000, 0.63460],
        [1212012000000, 0.63790],
        [1212098400000, 0.64160],
        [1212184800000, 0.64420],
        [1212271200000, 0.64310],
        [1212357600000, 0.64310],
        [1212444000000, 0.64350],
        [1212530400000, 0.6440],
        [1212616800000, 0.64730],
        [1212703200000, 0.64690],
        [1212789600000, 0.63860],
        [1212876000000, 0.63560],
        [1212962400000, 0.6340],
        [1213048800000, 0.63460],
        [1213135200000, 0.6430],
        [1213221600000, 0.64520],
        [1213308000000, 0.64670],
        [1213394400000, 0.65060],
        [1213480800000, 0.65040],
        [1213567200000, 0.65030],
        [1213653600000, 0.64810],
        [1213740000000, 0.64510],
        [1213826400000, 0.6450],
        [1213912800000, 0.64410],
        [1213999200000, 0.64140],
        [1214085600000, 0.64090],
        [1214172000000, 0.64090],
        [1214258400000, 0.64280],
        [1214344800000, 0.64310],
        [1214431200000, 0.64180],
        [1214517600000, 0.63710],
        [1214604000000, 0.63490],
        [1214690400000, 0.63330],
        [1214776800000, 0.63340],
        [1214863200000, 0.63380],
        [1214949600000, 0.63420],
        [1215036000000, 0.6320],
        [1215122400000, 0.63180],
        [1215208800000, 0.6370],
        [1215295200000, 0.63680],
        [1215381600000, 0.63680],
        [1215468000000, 0.63830],
        [1215554400000, 0.63710],
        [1215640800000, 0.63710],
        [1215727200000, 0.63550],
        [1215813600000, 0.6320],
        [1215900000000, 0.62770],
        [1215986400000, 0.62760],
        [1216072800000, 0.62910],
        [1216159200000, 0.62740],
        [1216245600000, 0.62930],
        [1216332000000, 0.63110],
        [1216418400000, 0.6310],
        [1216504800000, 0.63120],
        [1216591200000, 0.63120],
        [1216677600000, 0.63040],
        [1216764000000, 0.62940],
        [1216850400000, 0.63480],
        [1216936800000, 0.63780],
        [1217023200000, 0.63680],
        [1217109600000, 0.63680],
        [1217196000000, 0.63680],
        [1217282400000, 0.6360],
        [1217368800000, 0.6370],
        [1217455200000, 0.64180],
        [1217541600000, 0.64110],
        [1217628000000, 0.64350],
        [1217714400000, 0.64270],
        [1217800800000, 0.64270],
        [1217887200000, 0.64190],
        [1217973600000, 0.64460],
        [1218060000000, 0.64680],
        [1218146400000, 0.64870],
        [1218232800000, 0.65940],
        [1218319200000, 0.66660],
        [1218405600000, 0.66660],
        [1218492000000, 0.66780],
        [1218578400000, 0.67120],
        [1218664800000, 0.67050],
        [1218751200000, 0.67180],
        [1218837600000, 0.67840],
        [1218924000000, 0.68110],
        [1219010400000, 0.68110],
        [1219096800000, 0.67940],
        [1219183200000, 0.68040],
        [1219269600000, 0.67810],
        [1219356000000, 0.67560],
        [1219442400000, 0.67350],
        [1219528800000, 0.67630],
        [1219615200000, 0.67620],
        [1219701600000, 0.67770],
        [1219788000000, 0.68150],
        [1219874400000, 0.68020],
        [1219960800000, 0.6780],
        [1220047200000, 0.67960],
        [1220133600000, 0.68170],
        [1220220000000, 0.68170],
        [1220306400000, 0.68320],
        [1220392800000, 0.68770],
        [1220479200000, 0.69120],
        [1220565600000, 0.69140],
        [1220652000000, 0.70090],
        [1220738400000, 0.70120],
        [1220824800000, 0.7010],
        [1220911200000, 0.70050]
    ];

    function euroFormatter(v, axis) {
        return v.toFixed(axis.tickDecimals) + "€";
    }

    function doPlot(position) {
        $.plot($("#flot-multiple-axes-chart"), [{
            data: oilprices,
            label: "Oil price ($)"
        }, {
            data: exchangerates,
            label: "USD/EUR exchange rate",
            yaxis: 2
        }], {
            xaxes: [{
                mode: 'time'
            }],
            yaxes: [{
                min: 0
            }, {
                // align if we are to the right
                alignTicksWithAxis: position == "right" ? 1 : null,
                position: position,
                tickFormatter: euroFormatter
            }],
            legend: {
                position: 'sw'
            },
            grid: {
                hoverable: true //IMPORTANT! this is needed for tooltip to work
            },
            tooltip: true,
            tooltipOpts: {
                content: "%s for %x was %y",
                xDateFormat: "%y-%0m-%0d",

                onHover: function (flotItem, $tooltipEl) {
                    // console.log(flotItem, $tooltipEl);
                }
            }

        });
    }

    doPlot("right");

    $("button").click(function () {
        doPlot($(this).text());
    });
});

// Flot Chart Dynamic Chart

$(function () {

    var container = $("#flot-moving-line-chart");

    // Determine how many data points to keep based on the placeholder's initial size;
    // this gives us a nice high-res plot while avoiding more than one point per pixel.

    var maximum = container.outerWidth() / 2 || 300;

    //

    var data = [];

    function getRandomData() {

        if (data.length) {
            data = data.slice(1);
        }

        while (data.length < maximum) {
            var previous = data.length ? data[data.length - 1] : 50;
            var y = previous + Math.random() * 10 - 5;
            data.push(y < 0 ? 0 : y > 100 ? 100 : y);
        }

        // zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }

    //

    series = [{
        data: getRandomData(),
        lines: {
            fill: true
        }
    }];

    //

    var plot = $.plot(container, series, {
        grid: {
            borderWidth: 1,
            minBorderMargin: 20,
            labelMargin: 10,
            backgroundColor: {
                colors: ["#fff", "#e4f4f4"]
            },
            margin: {
                top: 8,
                bottom: 20,
                left: 20
            },
            markings: function (axes) {
                var markings = [];
                var xaxis = axes.xaxis;
                for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                    markings.push({
                        xaxis: {
                            from: x,
                            to: x + xaxis.tickSize
                        },
                        color: "rgba(232, 232, 255, 0.2)"
                    });
                }
                return markings;
            }
        },
        xaxis: {
            tickFormatter: function () {
                return "";
            }
        },
        yaxis: {
            min: 0,
            max: 110
        },
        legend: {
            show: true
        }
    });

    // Update the random dataset at 25FPS for a smoothly-animating chart

    setInterval(function updateRandom() {
        series[0].data = getRandomData();
        plot.setData(series);
        plot.draw();
    }, 40);

});

// Flot Chart Bar Graph

$(function () {

    var barOptions = {
        series: {
            bars: {
                show: true,
                barWidth: 43200000
            }
        },
        xaxis: {
            mode: "time",
            timeformat: "%m/%d",
            minTickSize: [1, "day"]
        },
        grid: {
            hoverable: true
        },
        legend: {
            show: false
        },
        tooltip: true,
        tooltipOpts: {
            content: "x: %x, y: %y"
        }
    };
    var barData = {
        label: "bar",
        data: [
            [1354521600000, 1000],
            [1355040000000, 2000],
            [1355223600000, 3000],
            [1355306400000, 4000],
            [1355487300000, 5000],
            [1355571900000, 6000]
        ]
    };
    $.plot($("#flot-bar-chart"), [barData], barOptions);

});

/*! Javascript plotting library for jQuery, v. 0.7.
 *
 * Released under the MIT license by IOLA, December 2007.
 *
 */

// first an inline dependency, jquery.colorhelpers.js, we inline it here
// for convenience

/* Plugin for jQuery for working with colors.
 * 
 * Version 1.1.
 * 
 * Inspiration from jQuery color animation plugin by John Resig.
 *
 * Released under the MIT license by Ole Laursen, October 2009.
 *
 * Examples:
 *
 *   $.color.parse("#fff").scale('rgb', 0.25).add('a', -0.5).toString()
 *   var c = $.color.extract($("#mydiv"), 'background-color');
 *   console.log(c.r, c.g, c.b, c.a);
 *   $.color.make(100, 50, 25, 0.4).toString() // returns "rgba(100,50,25,0.4)"
 *
 * Note that .scale() and .add() return the same modified object
 * instead of making a new one.
 *
 * V. 1.1: Fix error handling so e.g. parsing an empty string does
 * produce a color rather than just crashing.
 */
(function (B) {
    B.color = {};
    B.color.make = function (F, E, C, D) {
        var G = {};
        G.r = F || 0;
        G.g = E || 0;
        G.b = C || 0;
        G.a = D != null ? D : 1;
        G.add = function (J, I) {
            for (var H = 0; H < J.length; ++H) {
                G[J.charAt(H)] += I
            }
            return G.normalize()
        };
        G.scale = function (J, I) {
            for (var H = 0; H < J.length; ++H) {
                G[J.charAt(H)] *= I
            }
            return G.normalize()
        };
        G.toString = function () {
            if (G.a >= 1) {
                return "rgb(" + [G.r, G.g, G.b].join(",") + ")"
            } else {
                return "rgba(" + [G.r, G.g, G.b, G.a].join(",") + ")"
            }
        };
        G.normalize = function () {
            function H(J, K, I) {
                return K < J ? J : (K > I ? I : K)
            }

            G.r = H(0, parseInt(G.r), 255);
            G.g = H(0, parseInt(G.g), 255);
            G.b = H(0, parseInt(G.b), 255);
            G.a = H(0, G.a, 1);
            return G
        };
        G.clone = function () {
            return B.color.make(G.r, G.b, G.g, G.a)
        };
        return G.normalize()
    };
    B.color.extract = function (D, C) {
        var E;
        do {
            E = D.css(C).toLowerCase();
            if (E != "" && E != "transparent") {
                break
            }
            D = D.parent()
        } while (!B.nodeName(D.get(0), "body"));
        if (E == "rgba(0, 0, 0, 0)") {
            E = "transparent"
        }
        return B.color.parse(E)
    };
    B.color.parse = function (F) {
        var E, C = B.color.make;
        if (E = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(F)) {
            return C(parseInt(E[1], 10), parseInt(E[2], 10), parseInt(E[3], 10))
        }
        if (E = /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(F)) {
            return C(parseInt(E[1], 10), parseInt(E[2], 10), parseInt(E[3], 10), parseFloat(E[4]))
        }
        if (E = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(F)) {
            return C(parseFloat(E[1]) * 2.55, parseFloat(E[2]) * 2.55, parseFloat(E[3]) * 2.55)
        }
        if (E = /rgba\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(F)) {
            return C(parseFloat(E[1]) * 2.55, parseFloat(E[2]) * 2.55, parseFloat(E[3]) * 2.55, parseFloat(E[4]))
        }
        if (E = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(F)) {
            return C(parseInt(E[1], 16), parseInt(E[2], 16), parseInt(E[3], 16))
        }
        if (E = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(F)) {
            return C(parseInt(E[1] + E[1], 16), parseInt(E[2] + E[2], 16), parseInt(E[3] + E[3], 16))
        }
        var D = B.trim(F).toLowerCase();
        if (D == "transparent") {
            return C(255, 255, 255, 0)
        } else {
            E = A[D] || [0, 0, 0];
            return C(E[0], E[1], E[2])
        }
    };
    var A = {
        aqua: [0, 255, 255],
        azure: [240, 255, 255],
        beige: [245, 245, 220],
        black: [0, 0, 0],
        blue: [0, 0, 255],
        brown: [165, 42, 42],
        cyan: [0, 255, 255],
        darkblue: [0, 0, 139],
        darkcyan: [0, 139, 139],
        darkgrey: [169, 169, 169],
        darkgreen: [0, 100, 0],
        darkkhaki: [189, 183, 107],
        darkmagenta: [139, 0, 139],
        darkolivegreen: [85, 107, 47],
        darkorange: [255, 140, 0],
        darkorchid: [153, 50, 204],
        darkred: [139, 0, 0],
        darksalmon: [233, 150, 122],
        darkviolet: [148, 0, 211],
        fuchsia: [255, 0, 255],
        gold: [255, 215, 0],
        green: [0, 128, 0],
        indigo: [75, 0, 130],
        khaki: [240, 230, 140],
        lightblue: [173, 216, 230],
        lightcyan: [224, 255, 255],
        lightgreen: [144, 238, 144],
        lightgrey: [211, 211, 211],
        lightpink: [255, 182, 193],
        lightyellow: [255, 255, 224],
        lime: [0, 255, 0],
        magenta: [255, 0, 255],
        maroon: [128, 0, 0],
        navy: [0, 0, 128],
        olive: [128, 128, 0],
        orange: [255, 165, 0],
        pink: [255, 192, 203],
        purple: [128, 0, 128],
        violet: [128, 0, 128],
        red: [255, 0, 0],
        silver: [192, 192, 192],
        white: [255, 255, 255],
        yellow: [255, 255, 0]
    }
})(jQuery);

// the actual Flot code
(function ($) {
    function Plot(placeholder, data_, options_, plugins) {
        // data is on the form:
        //   [ series1, series2 ... ]
        // where series is either just the data as [ [x1, y1], [x2, y2], ... ]
        // or { data: [ [x1, y1], [x2, y2], ... ], label: "some label", ... }

        var series = [],
            options = {
                // the color theme used for graphs
                colors: ["#edc240", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"],
                legend: {
                    show: true,
                    noColumns: 1, // number of colums in legend table
                    labelFormatter: null, // fn: string -> string
                    labelBoxBorderColor: "#ccc", // border color for the little label boxes
                    container: null, // container (as jQuery object) to put legend in, null means default on top of graph
                    position: "ne", // position of default legend container within plot
                    margin: 5, // distance from grid edge to default legend container within plot
                    backgroundColor: null, // null means auto-detect
                    backgroundOpacity: 0.85 // set to 0 to avoid background
                },
                xaxis: {
                    show: null, // null = auto-detect, true = always, false = never
                    position: "bottom", // or "top"
                    mode: null, // null or "time"
                    color: null, // base color, labels, ticks
                    tickColor: null, // possibly different color of ticks, e.g. "rgba(0,0,0,0.15)"
                    transform: null, // null or f: number -> number to transform axis
                    inverseTransform: null, // if transform is set, this should be the inverse function
                    min: null, // min. value to show, null means set automatically
                    max: null, // max. value to show, null means set automatically
                    autoscaleMargin: null, // margin in % to add if auto-setting min/max
                    ticks: null, // either [1, 3] or [[1, "a"], 3] or (fn: axis info -> ticks) or app. number of ticks for auto-ticks
                    tickFormatter: null, // fn: number -> string
                    labelWidth: null, // size of tick labels in pixels
                    labelHeight: null,
                    reserveSpace: null, // whether to reserve space even if axis isn't shown
                    tickLength: null, // size in pixels of ticks, or "full" for whole line
                    alignTicksWithAxis: null, // axis number or null for no sync

                    // mode specific options
                    tickDecimals: null, // no. of decimals, null means auto
                    tickSize: null, // number or [number, "unit"]
                    minTickSize: null, // number or [number, "unit"]
                    monthNames: null, // list of names of months
                    timeformat: null, // format string to use
                    twelveHourClock: false // 12 or 24 time in time mode
                },
                yaxis: {
                    autoscaleMargin: 0.02,
                    position: "left" // or "right"
                },
                xaxes: [],
                yaxes: [],
                series: {
                    points: {
                        show: false,
                        radius: 3,
                        lineWidth: 2, // in pixels
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle" // or callback
                    },
                    lines: {
                        // we don't put in show: false so we can see
                        // whether lines were actively disabled 
                        lineWidth: 2, // in pixels
                        fill: false,
                        fillColor: null,
                        steps: false
                    },
                    bars: {
                        show: false,
                        lineWidth: 2, // in pixels
                        barWidth: 1, // in units of the x axis
                        fill: true,
                        fillColor: null,
                        align: "left", // or "center" 
                        horizontal: false
                    },
                    shadowSize: 3
                },
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#545454", // primary color used for outline and labels
                    backgroundColor: null, // null for transparent, else color
                    borderColor: null, // set if different from the grid color
                    tickColor: null, // color for the ticks, e.g. "rgba(0,0,0,0.15)"
                    labelMargin: 5, // in pixels
                    axisMargin: 8, // in pixels
                    borderWidth: 2, // in pixels
                    minBorderMargin: null, // in pixels, null means taken from points radius
                    markings: null, // array of ranges or fn: axes -> array of ranges
                    markingsColor: "#f4f4f4",
                    markingsLineWidth: 2,
                    // interactive stuff
                    clickable: false,
                    hoverable: false,
                    autoHighlight: true, // highlight in case mouse is near
                    mouseActiveRadius: 10 // how far the mouse can be away to activate an item
                },
                hooks: {}
            },
            canvas = null,      // the canvas for the plot itself
            overlay = null,     // canvas for interactive stuff on top of plot
            eventHolder = null, // jQuery object that events should be bound to
            ctx = null, octx = null,
            xaxes = [], yaxes = [],
            plotOffset = {left: 0, right: 0, top: 0, bottom: 0},
            canvasWidth = 0, canvasHeight = 0,
            plotWidth = 0, plotHeight = 0,
            hooks = {
                processOptions: [],
                processRawData: [],
                processDatapoints: [],
                drawSeries: [],
                draw: [],
                bindEvents: [],
                drawOverlay: [],
                shutdown: []
            },
            plot = this;

        // public functions
        plot.setData = setData;
        plot.setupGrid = setupGrid;
        plot.draw = draw;
        plot.getPlaceholder = function () {
            return placeholder;
        };
        plot.getCanvas = function () {
            return canvas;
        };
        plot.getPlotOffset = function () {
            return plotOffset;
        };
        plot.width = function () {
            return plotWidth;
        };
        plot.height = function () {
            return plotHeight;
        };
        plot.offset = function () {
            var o = eventHolder.offset();
            o.left += plotOffset.left;
            o.top += plotOffset.top;
            return o;
        };
        plot.getData = function () {
            return series;
        };
        plot.getAxes = function () {
            var res = {}, i;
            $.each(xaxes.concat(yaxes), function (_, axis) {
                if (axis)
                    res[axis.direction + (axis.n != 1 ? axis.n : "") + "axis"] = axis;
            });
            return res;
        };
        plot.getXAxes = function () {
            return xaxes;
        };
        plot.getYAxes = function () {
            return yaxes;
        };
        plot.c2p = canvasToAxisCoords;
        plot.p2c = axisToCanvasCoords;
        plot.getOptions = function () {
            return options;
        };
        plot.highlight = highlight;
        plot.unhighlight = unhighlight;
        plot.triggerRedrawOverlay = triggerRedrawOverlay;
        plot.pointOffset = function (point) {
            return {
                left: parseInt(xaxes[axisNumber(point, "x") - 1].p2c(+point.x) + plotOffset.left),
                top: parseInt(yaxes[axisNumber(point, "y") - 1].p2c(+point.y) + plotOffset.top)
            };
        };
        plot.shutdown = shutdown;
        plot.resize = function () {
            getCanvasDimensions();
            resizeCanvas(canvas);
            resizeCanvas(overlay);
        };

        // public attributes
        plot.hooks = hooks;

        // initialize
        initPlugins(plot);
        parseOptions(options_);
        setupCanvases();
        setData(data_);
        setupGrid();
        draw();
        bindEvents();


        function executeHooks(hook, args) {
            args = [plot].concat(args);
            for (var i = 0; i < hook.length; ++i)
                hook[i].apply(this, args);
        }

        function initPlugins() {
            for (var i = 0; i < plugins.length; ++i) {
                var p = plugins[i];
                p.init(plot);
                if (p.options)
                    $.extend(true, options, p.options);
            }
        }

        function parseOptions(opts) {
            var i;

            $.extend(true, options, opts);

            if (options.xaxis.color == null)
                options.xaxis.color = options.grid.color;
            if (options.yaxis.color == null)
                options.yaxis.color = options.grid.color;

            if (options.xaxis.tickColor == null) // backwards-compatibility
                options.xaxis.tickColor = options.grid.tickColor;
            if (options.yaxis.tickColor == null) // backwards-compatibility
                options.yaxis.tickColor = options.grid.tickColor;

            if (options.grid.borderColor == null)
                options.grid.borderColor = options.grid.color;
            if (options.grid.tickColor == null)
                options.grid.tickColor = $.color.parse(options.grid.color).scale('a', 0.22).toString();

            // fill in defaults in axes, copy at least always the
            // first as the rest of the code assumes it'll be there
            for (i = 0; i < Math.max(1, options.xaxes.length); ++i)
                options.xaxes[i] = $.extend(true, {}, options.xaxis, options.xaxes[i]);
            for (i = 0; i < Math.max(1, options.yaxes.length); ++i)
                options.yaxes[i] = $.extend(true, {}, options.yaxis, options.yaxes[i]);

            // backwards compatibility, to be removed in future
            if (options.xaxis.noTicks && options.xaxis.ticks == null)
                options.xaxis.ticks = options.xaxis.noTicks;
            if (options.yaxis.noTicks && options.yaxis.ticks == null)
                options.yaxis.ticks = options.yaxis.noTicks;
            if (options.x2axis) {
                options.xaxes[1] = $.extend(true, {}, options.xaxis, options.x2axis);
                options.xaxes[1].position = "top";
            }
            if (options.y2axis) {
                options.yaxes[1] = $.extend(true, {}, options.yaxis, options.y2axis);
                options.yaxes[1].position = "right";
            }
            if (options.grid.coloredAreas)
                options.grid.markings = options.grid.coloredAreas;
            if (options.grid.coloredAreasColor)
                options.grid.markingsColor = options.grid.coloredAreasColor;
            if (options.lines)
                $.extend(true, options.series.lines, options.lines);
            if (options.points)
                $.extend(true, options.series.points, options.points);
            if (options.bars)
                $.extend(true, options.series.bars, options.bars);
            if (options.shadowSize != null)
                options.series.shadowSize = options.shadowSize;

            // save options on axes for future reference
            for (i = 0; i < options.xaxes.length; ++i)
                getOrCreateAxis(xaxes, i + 1).options = options.xaxes[i];
            for (i = 0; i < options.yaxes.length; ++i)
                getOrCreateAxis(yaxes, i + 1).options = options.yaxes[i];

            // add hooks from options
            for (var n in hooks)
                if (options.hooks[n] && options.hooks[n].length)
                    hooks[n] = hooks[n].concat(options.hooks[n]);

            executeHooks(hooks.processOptions, [options]);
        }

        function setData(d) {
            series = parseData(d);
            fillInSeriesOptions();
            processData();
        }

        function parseData(d) {
            var res = [];
            for (var i = 0; i < d.length; ++i) {
                var s = $.extend(true, {}, options.series);

                if (d[i].data != null) {
                    s.data = d[i].data; // move the data instead of deep-copy
                    delete d[i].data;

                    $.extend(true, s, d[i]);

                    d[i].data = s.data;
                }
                else
                    s.data = d[i];
                res.push(s);
            }

            return res;
        }

        function axisNumber(obj, coord) {
            var a = obj[coord + "axis"];
            if (typeof a == "object") // if we got a real axis, extract number
                a = a.n;
            if (typeof a != "number")
                a = 1; // default to first axis
            return a;
        }

        function allAxes() {
            // return flat array without annoying null entries
            return $.grep(xaxes.concat(yaxes), function (a) {
                return a;
            });
        }

        function canvasToAxisCoords(pos) {
            // return an object with x/y corresponding to all used axes 
            var res = {}, i, axis;
            for (i = 0; i < xaxes.length; ++i) {
                axis = xaxes[i];
                if (axis && axis.used)
                    res["x" + axis.n] = axis.c2p(pos.left);
            }

            for (i = 0; i < yaxes.length; ++i) {
                axis = yaxes[i];
                if (axis && axis.used)
                    res["y" + axis.n] = axis.c2p(pos.top);
            }

            if (res.x1 !== undefined)
                res.x = res.x1;
            if (res.y1 !== undefined)
                res.y = res.y1;

            return res;
        }

        function axisToCanvasCoords(pos) {
            // get canvas coords from the first pair of x/y found in pos
            var res = {}, i, axis, key;

            for (i = 0; i < xaxes.length; ++i) {
                axis = xaxes[i];
                if (axis && axis.used) {
                    key = "x" + axis.n;
                    if (pos[key] == null && axis.n == 1)
                        key = "x";

                    if (pos[key] != null) {
                        res.left = axis.p2c(pos[key]);
                        break;
                    }
                }
            }

            for (i = 0; i < yaxes.length; ++i) {
                axis = yaxes[i];
                if (axis && axis.used) {
                    key = "y" + axis.n;
                    if (pos[key] == null && axis.n == 1)
                        key = "y";

                    if (pos[key] != null) {
                        res.top = axis.p2c(pos[key]);
                        break;
                    }
                }
            }

            return res;
        }

        function getOrCreateAxis(axes, number) {
            if (!axes[number - 1])
                axes[number - 1] = {
                    n: number, // save the number for future reference
                    direction: axes == xaxes ? "x" : "y",
                    options: $.extend(true, {}, axes == xaxes ? options.xaxis : options.yaxis)
                };

            return axes[number - 1];
        }

        function fillInSeriesOptions() {
            var i;

            // collect what we already got of colors
            var neededColors = series.length,
                usedColors = [],
                assignedColors = [];
            for (i = 0; i < series.length; ++i) {
                var sc = series[i].color;
                if (sc != null) {
                    --neededColors;
                    if (typeof sc == "number")
                        assignedColors.push(sc);
                    else
                        usedColors.push($.color.parse(series[i].color));
                }
            }

            // we might need to generate more colors if higher indices
            // are assigned
            for (i = 0; i < assignedColors.length; ++i) {
                neededColors = Math.max(neededColors, assignedColors[i] + 1);
            }

            // produce colors as needed
            var colors = [], variation = 0;
            i = 0;
            while (colors.length < neededColors) {
                var c;
                if (options.colors.length == i) // check degenerate case
                    c = $.color.make(100, 100, 100);
                else
                    c = $.color.parse(options.colors[i]);

                // vary color if needed
                var sign = variation % 2 == 1 ? -1 : 1;
                c.scale('rgb', 1 + sign * Math.ceil(variation / 2) * 0.2);

                // FIXME: if we're getting to close to something else,
                // we should probably skip this one
                colors.push(c);

                ++i;
                if (i >= options.colors.length) {
                    i = 0;
                    ++variation;
                }
            }

            // fill in the options
            var colori = 0, s;
            for (i = 0; i < series.length; ++i) {
                s = series[i];

                // assign colors
                if (s.color == null) {
                    s.color = colors[colori].toString();
                    ++colori;
                }
                else if (typeof s.color == "number")
                    s.color = colors[s.color].toString();

                // turn on lines automatically in case nothing is set
                if (s.lines.show == null) {
                    var v, show = true;
                    for (v in s)
                        if (s[v] && s[v].show) {
                            show = false;
                            break;
                        }
                    if (show)
                        s.lines.show = true;
                }

                // setup axes
                s.xaxis = getOrCreateAxis(xaxes, axisNumber(s, "x"));
                s.yaxis = getOrCreateAxis(yaxes, axisNumber(s, "y"));
            }
        }

        function processData() {
            var topSentry = Number.POSITIVE_INFINITY,
                bottomSentry = Number.NEGATIVE_INFINITY,
                fakeInfinity = Number.MAX_VALUE,
                i, j, k, m, length,
                s, points, ps, x, y, axis, val, f, p;

            function updateAxis(axis, min, max) {
                if (min < axis.datamin && min != -fakeInfinity)
                    axis.datamin = min;
                if (max > axis.datamax && max != fakeInfinity)
                    axis.datamax = max;
            }

            $.each(allAxes(), function (_, axis) {
                // init axis
                axis.datamin = topSentry;
                axis.datamax = bottomSentry;
                axis.used = false;
            });

            for (i = 0; i < series.length; ++i) {
                s = series[i];
                s.datapoints = {points: []};

                executeHooks(hooks.processRawData, [s, s.data, s.datapoints]);
            }

            // first pass: clean and copy data
            for (i = 0; i < series.length; ++i) {
                s = series[i];

                var data = s.data, format = s.datapoints.format;

                if (!format) {
                    format = [];
                    // find out how to copy
                    format.push({x: true, number: true, required: true});
                    format.push({y: true, number: true, required: true});

                    if (s.bars.show || (s.lines.show && s.lines.fill)) {
                        format.push({y: true, number: true, required: false, defaultValue: 0});
                        if (s.bars.horizontal) {
                            delete format[format.length - 1].y;
                            format[format.length - 1].x = true;
                        }
                    }

                    s.datapoints.format = format;
                }

                if (s.datapoints.pointsize != null)
                    continue; // already filled in

                s.datapoints.pointsize = format.length;

                ps = s.datapoints.pointsize;
                points = s.datapoints.points;

                insertSteps = s.lines.show && s.lines.steps;
                s.xaxis.used = s.yaxis.used = true;

                for (j = k = 0; j < data.length; ++j, k += ps) {
                    p = data[j];

                    var nullify = p == null;
                    if (!nullify) {
                        for (m = 0; m < ps; ++m) {
                            val = p[m];
                            f = format[m];

                            if (f) {
                                if (f.number && val != null) {
                                    val = +val; // convert to number
                                    if (isNaN(val))
                                        val = null;
                                    else if (val == Infinity)
                                        val = fakeInfinity;
                                    else if (val == -Infinity)
                                        val = -fakeInfinity;
                                }

                                if (val == null) {
                                    if (f.required)
                                        nullify = true;

                                    if (f.defaultValue != null)
                                        val = f.defaultValue;
                                }
                            }

                            points[k + m] = val;
                        }
                    }

                    if (nullify) {
                        for (m = 0; m < ps; ++m) {
                            val = points[k + m];
                            if (val != null) {
                                f = format[m];
                                // extract min/max info
                                if (f.x)
                                    updateAxis(s.xaxis, val, val);
                                if (f.y)
                                    updateAxis(s.yaxis, val, val);
                            }
                            points[k + m] = null;
                        }
                    }
                    else {
                        // a little bit of line specific stuff that
                        // perhaps shouldn't be here, but lacking
                        // better means...
                        if (insertSteps && k > 0
                            && points[k - ps] != null
                            && points[k - ps] != points[k]
                            && points[k - ps + 1] != points[k + 1]) {
                            // copy the point to make room for a middle point
                            for (m = 0; m < ps; ++m)
                                points[k + ps + m] = points[k + m];

                            // middle point has same y
                            points[k + 1] = points[k - ps + 1];

                            // we've added a point, better reflect that
                            k += ps;
                        }
                    }
                }
            }

            // give the hooks a chance to run
            for (i = 0; i < series.length; ++i) {
                s = series[i];

                executeHooks(hooks.processDatapoints, [s, s.datapoints]);
            }

            // second pass: find datamax/datamin for auto-scaling
            for (i = 0; i < series.length; ++i) {
                s = series[i];
                points = s.datapoints.points,
                    ps = s.datapoints.pointsize;

                var xmin = topSentry, ymin = topSentry,
                    xmax = bottomSentry, ymax = bottomSentry;

                for (j = 0; j < points.length; j += ps) {
                    if (points[j] == null)
                        continue;

                    for (m = 0; m < ps; ++m) {
                        val = points[j + m];
                        f = format[m];
                        if (!f || val == fakeInfinity || val == -fakeInfinity)
                            continue;

                        if (f.x) {
                            if (val < xmin)
                                xmin = val;
                            if (val > xmax)
                                xmax = val;
                        }
                        if (f.y) {
                            if (val < ymin)
                                ymin = val;
                            if (val > ymax)
                                ymax = val;
                        }
                    }
                }

                if (s.bars.show) {
                    // make sure we got room for the bar on the dancing floor
                    var delta = s.bars.align == "left" ? 0 : -s.bars.barWidth / 2;
                    if (s.bars.horizontal) {
                        ymin += delta;
                        ymax += delta + s.bars.barWidth;
                    }
                    else {
                        xmin += delta;
                        xmax += delta + s.bars.barWidth;
                    }
                }

                updateAxis(s.xaxis, xmin, xmax);
                updateAxis(s.yaxis, ymin, ymax);
            }

            $.each(allAxes(), function (_, axis) {
                if (axis.datamin == topSentry)
                    axis.datamin = null;
                if (axis.datamax == bottomSentry)
                    axis.datamax = null;
            });
        }

        function makeCanvas(skipPositioning, cls) {
            var c = document.createElement('canvas');
            c.className = cls;
            c.width = canvasWidth;
            c.height = canvasHeight;

            if (!skipPositioning)
                $(c).css({position: 'absolute', left: 0, top: 0});

            $(c).appendTo(placeholder);

            if (!c.getContext) // excanvas hack
                c = window.G_vmlCanvasManager.initElement(c);

            // used for resetting in case we get replotted
            c.getContext("2d").save();

            return c;
        }

        function getCanvasDimensions() {
            canvasWidth = placeholder.width();
            canvasHeight = placeholder.height();

            if (canvasWidth <= 0 || canvasHeight <= 0)
                throw "Invalid dimensions for plot, width = " + canvasWidth + ", height = " + canvasHeight;
        }

        function resizeCanvas(c) {
            // resizing should reset the state (excanvas seems to be
            // buggy though)
            if (c.width != canvasWidth)
                c.width = canvasWidth;

            if (c.height != canvasHeight)
                c.height = canvasHeight;

            // so try to get back to the initial state (even if it's
            // gone now, this should be safe according to the spec)
            var cctx = c.getContext("2d");
            cctx.restore();

            // and save again
            cctx.save();
        }

        function setupCanvases() {
            var reused,
                existingCanvas = placeholder.children("canvas.base"),
                existingOverlay = placeholder.children("canvas.overlay");

            if (existingCanvas.length == 0 || existingOverlay == 0) {
                // init everything

                placeholder.html(""); // make sure placeholder is clear

                placeholder.css({padding: 0}); // padding messes up the positioning

                if (placeholder.css("position") == 'static')
                    placeholder.css("position", "relative"); // for positioning labels and overlay

                getCanvasDimensions();

                canvas = makeCanvas(true, "base");
                overlay = makeCanvas(false, "overlay"); // overlay canvas for interactive features

                reused = false;
            }
            else {
                // reuse existing elements

                canvas = existingCanvas.get(0);
                overlay = existingOverlay.get(0);

                reused = true;
            }

            ctx = canvas.getContext("2d");
            octx = overlay.getContext("2d");

            // we include the canvas in the event holder too, because IE 7
            // sometimes has trouble with the stacking order
            eventHolder = $([overlay, canvas]);

            if (reused) {
                // run shutdown in the old plot object
                placeholder.data("plot").shutdown();

                // reset reused canvases
                plot.resize();

                // make sure overlay pixels are cleared (canvas is cleared when we redraw)
                octx.clearRect(0, 0, canvasWidth, canvasHeight);

                // then whack any remaining obvious garbage left
                eventHolder.unbind();
                placeholder.children().not([canvas, overlay]).remove();
            }

            // save in case we get replotted
            placeholder.data("plot", plot);
        }

        function bindEvents() {
            // bind events
            if (options.grid.hoverable) {
                eventHolder.mousemove(onMouseMove);
                eventHolder.mouseleave(onMouseLeave);
            }

            if (options.grid.clickable)
                eventHolder.click(onClick);

            executeHooks(hooks.bindEvents, [eventHolder]);
        }

        function shutdown() {
            if (redrawTimeout)
                clearTimeout(redrawTimeout);

            eventHolder.unbind("mousemove", onMouseMove);
            eventHolder.unbind("mouseleave", onMouseLeave);
            eventHolder.unbind("click", onClick);

            executeHooks(hooks.shutdown, [eventHolder]);
        }

        function setTransformationHelpers(axis) {
            // set helper functions on the axis, assumes plot area
            // has been computed already

            function identity(x) {
                return x;
            }

            var s, m, t = axis.options.transform || identity,
                it = axis.options.inverseTransform;

            // precompute how much the axis is scaling a point
            // in canvas space
            if (axis.direction == "x") {
                s = axis.scale = plotWidth / Math.abs(t(axis.max) - t(axis.min));
                m = Math.min(t(axis.max), t(axis.min));
            }
            else {
                s = axis.scale = plotHeight / Math.abs(t(axis.max) - t(axis.min));
                s = -s;
                m = Math.max(t(axis.max), t(axis.min));
            }

            // data point to canvas coordinate
            if (t == identity) // slight optimization
                axis.p2c = function (p) {
                    return (p - m) * s;
                };
            else
                axis.p2c = function (p) {
                    return (t(p) - m) * s;
                };
            // canvas coordinate to data point
            if (!it)
                axis.c2p = function (c) {
                    return m + c / s;
                };
            else
                axis.c2p = function (c) {
                    return it(m + c / s);
                };
        }

        function measureTickLabels(axis) {
            var opts = axis.options, i, ticks = axis.ticks || [], labels = [],
                l, w = opts.labelWidth, h = opts.labelHeight, dummyDiv;

            function makeDummyDiv(labels, width) {
                return $('<div style="position:absolute;top:-10000px;' + width + 'font-size:smaller">' +
                '<div class="' + axis.direction + 'Axis ' + axis.direction + axis.n + 'Axis">'
                + labels.join("") + '</div></div>')
                    .appendTo(placeholder);
            }

            if (axis.direction == "x") {
                // to avoid measuring the widths of the labels (it's slow), we
                // construct fixed-size boxes and put the labels inside
                // them, we don't need the exact figures and the
                // fixed-size box content is easy to center
                if (w == null)
                    w = Math.floor(canvasWidth / (ticks.length > 0 ? ticks.length : 1));

                // measure x label heights
                if (h == null) {
                    labels = [];
                    for (i = 0; i < ticks.length; ++i) {
                        l = ticks[i].label;
                        if (l)
                            labels.push('<div class="tickLabel" style="float:left;width:' + w + 'px">' + l + '</div>');
                    }

                    if (labels.length > 0) {
                        // stick them all in the same div and measure
                        // collective height
                        labels.push('<div style="clear:left"></div>');
                        dummyDiv = makeDummyDiv(labels, "width:10000px;");
                        h = dummyDiv.height();
                        dummyDiv.remove();
                    }
                }
            }
            else if (w == null || h == null) {
                // calculate y label dimensions
                for (i = 0; i < ticks.length; ++i) {
                    l = ticks[i].label;
                    if (l)
                        labels.push('<div class="tickLabel">' + l + '</div>');
                }

                if (labels.length > 0) {
                    dummyDiv = makeDummyDiv(labels, "");
                    if (w == null)
                        w = dummyDiv.children().width();
                    if (h == null)
                        h = dummyDiv.find("div.tickLabel").height();
                    dummyDiv.remove();
                }
            }

            if (w == null)
                w = 0;
            if (h == null)
                h = 0;

            axis.labelWidth = w;
            axis.labelHeight = h;
        }

        function allocateAxisBoxFirstPhase(axis) {
            // find the bounding box of the axis by looking at label
            // widths/heights and ticks, make room by diminishing the
            // plotOffset

            var lw = axis.labelWidth,
                lh = axis.labelHeight,
                pos = axis.options.position,
                tickLength = axis.options.tickLength,
                axismargin = options.grid.axisMargin,
                padding = options.grid.labelMargin,
                all = axis.direction == "x" ? xaxes : yaxes,
                index;

            // determine axis margin
            var samePosition = $.grep(all, function (a) {
                return a && a.options.position == pos && a.reserveSpace;
            });
            if ($.inArray(axis, samePosition) == samePosition.length - 1)
                axismargin = 0; // outermost

            // determine tick length - if we're innermost, we can use "full"
            if (tickLength == null)
                tickLength = "full";

            var sameDirection = $.grep(all, function (a) {
                return a && a.reserveSpace;
            });

            var innermost = $.inArray(axis, sameDirection) == 0;
            if (!innermost && tickLength == "full")
                tickLength = 5;

            if (!isNaN(+tickLength))
                padding += +tickLength;

            // compute box
            if (axis.direction == "x") {
                lh += padding;

                if (pos == "bottom") {
                    plotOffset.bottom += lh + axismargin;
                    axis.box = {top: canvasHeight - plotOffset.bottom, height: lh};
                }
                else {
                    axis.box = {top: plotOffset.top + axismargin, height: lh};
                    plotOffset.top += lh + axismargin;
                }
            }
            else {
                lw += padding;

                if (pos == "left") {
                    axis.box = {left: plotOffset.left + axismargin, width: lw};
                    plotOffset.left += lw + axismargin;
                }
                else {
                    plotOffset.right += lw + axismargin;
                    axis.box = {left: canvasWidth - plotOffset.right, width: lw};
                }
            }

            // save for future reference
            axis.position = pos;
            axis.tickLength = tickLength;
            axis.box.padding = padding;
            axis.innermost = innermost;
        }

        function allocateAxisBoxSecondPhase(axis) {
            // set remaining bounding box coordinates
            if (axis.direction == "x") {
                axis.box.left = plotOffset.left;
                axis.box.width = plotWidth;
            }
            else {
                axis.box.top = plotOffset.top;
                axis.box.height = plotHeight;
            }
        }

        function setupGrid() {
            var i, axes = allAxes();

            // first calculate the plot and axis box dimensions

            $.each(axes, function (_, axis) {
                axis.show = axis.options.show;
                if (axis.show == null)
                    axis.show = axis.used; // by default an axis is visible if it's got data

                axis.reserveSpace = axis.show || axis.options.reserveSpace;

                setRange(axis);
            });

            allocatedAxes = $.grep(axes, function (axis) {
                return axis.reserveSpace;
            });

            plotOffset.left = plotOffset.right = plotOffset.top = plotOffset.bottom = 0;
            if (options.grid.show) {
                $.each(allocatedAxes, function (_, axis) {
                    // make the ticks
                    setupTickGeneration(axis);
                    setTicks(axis);
                    snapRangeToTicks(axis, axis.ticks);

                    // find labelWidth/Height for axis
                    measureTickLabels(axis);
                });

                // with all dimensions in house, we can compute the
                // axis boxes, start from the outside (reverse order)
                for (i = allocatedAxes.length - 1; i >= 0; --i)
                    allocateAxisBoxFirstPhase(allocatedAxes[i]);

                // make sure we've got enough space for things that
                // might stick out
                var minMargin = options.grid.minBorderMargin;
                if (minMargin == null) {
                    minMargin = 0;
                    for (i = 0; i < series.length; ++i)
                        minMargin = Math.max(minMargin, series[i].points.radius + series[i].points.lineWidth / 2);
                }

                for (var a in plotOffset) {
                    plotOffset[a] += options.grid.borderWidth;
                    plotOffset[a] = Math.max(minMargin, plotOffset[a]);
                }
            }

            plotWidth = canvasWidth - plotOffset.left - plotOffset.right;
            plotHeight = canvasHeight - plotOffset.bottom - plotOffset.top;

            // now we got the proper plotWidth/Height, we can compute the scaling
            $.each(axes, function (_, axis) {
                setTransformationHelpers(axis);
            });

            if (options.grid.show) {
                $.each(allocatedAxes, function (_, axis) {
                    allocateAxisBoxSecondPhase(axis);
                });

                insertAxisLabels();
            }

            insertLegend();
        }

        function setRange(axis) {
            var opts = axis.options,
                min = +(opts.min != null ? opts.min : axis.datamin),
                max = +(opts.max != null ? opts.max : axis.datamax),
                delta = max - min;

            if (delta == 0.0) {
                // degenerate case
                var widen = max == 0 ? 1 : 0.01;

                if (opts.min == null)
                    min -= widen;
                // always widen max if we couldn't widen min to ensure we
                // don't fall into min == max which doesn't work
                if (opts.max == null || opts.min != null)
                    max += widen;
            }
            else {
                // consider autoscaling
                var margin = opts.autoscaleMargin;
                if (margin != null) {
                    if (opts.min == null) {
                        min -= delta * margin;
                        // make sure we don't go below zero if all values
                        // are positive
                        if (min < 0 && axis.datamin != null && axis.datamin >= 0)
                            min = 0;
                    }
                    if (opts.max == null) {
                        max += delta * margin;
                        if (max > 0 && axis.datamax != null && axis.datamax <= 0)
                            max = 0;
                    }
                }
            }
            axis.min = min;
            axis.max = max;
        }

        function setupTickGeneration(axis) {
            var opts = axis.options;

            // estimate number of ticks
            var noTicks;
            if (typeof opts.ticks == "number" && opts.ticks > 0)
                noTicks = opts.ticks;
            else
            // heuristic based on the model a*sqrt(x) fitted to
            // some data points that seemed reasonable
                noTicks = 0.3 * Math.sqrt(axis.direction == "x" ? canvasWidth : canvasHeight);

            var delta = (axis.max - axis.min) / noTicks,
                size, generator, unit, formatter, i, magn, norm;

            if (opts.mode == "time") {
                // pretty handling of time

                // map of app. size of time units in milliseconds
                var timeUnitSize = {
                    "second": 1000,
                    "minute": 60 * 1000,
                    "hour": 60 * 60 * 1000,
                    "day": 24 * 60 * 60 * 1000,
                    "month": 30 * 24 * 60 * 60 * 1000,
                    "year": 365.2425 * 24 * 60 * 60 * 1000
                };


                // the allowed tick sizes, after 1 year we use
                // an integer algorithm
                var spec = [
                    [1, "second"], [2, "second"], [5, "second"], [10, "second"],
                    [30, "second"],
                    [1, "minute"], [2, "minute"], [5, "minute"], [10, "minute"],
                    [30, "minute"],
                    [1, "hour"], [2, "hour"], [4, "hour"],
                    [8, "hour"], [12, "hour"],
                    [1, "day"], [2, "day"], [3, "day"],
                    [0.25, "month"], [0.5, "month"], [1, "month"],
                    [2, "month"], [3, "month"], [6, "month"],
                    [1, "year"]
                ];

                var minSize = 0;
                if (opts.minTickSize != null) {
                    if (typeof opts.tickSize == "number")
                        minSize = opts.tickSize;
                    else
                        minSize = opts.minTickSize[0] * timeUnitSize[opts.minTickSize[1]];
                }

                for (var i = 0; i < spec.length - 1; ++i)
                    if (delta < (spec[i][0] * timeUnitSize[spec[i][1]]
                        + spec[i + 1][0] * timeUnitSize[spec[i + 1][1]]) / 2
                        && spec[i][0] * timeUnitSize[spec[i][1]] >= minSize)
                        break;
                size = spec[i][0];
                unit = spec[i][1];

                // special-case the possibility of several years
                if (unit == "year") {
                    magn = Math.pow(10, Math.floor(Math.log(delta / timeUnitSize.year) / Math.LN10));
                    norm = (delta / timeUnitSize.year) / magn;
                    if (norm < 1.5)
                        size = 1;
                    else if (norm < 3)
                        size = 2;
                    else if (norm < 7.5)
                        size = 5;
                    else
                        size = 10;

                    size *= magn;
                }

                axis.tickSize = opts.tickSize || [size, unit];

                generator = function (axis) {
                    var ticks = [],
                        tickSize = axis.tickSize[0], unit = axis.tickSize[1],
                        d = new Date(axis.min);

                    var step = tickSize * timeUnitSize[unit];

                    if (unit == "second")
                        d.setUTCSeconds(floorInBase(d.getUTCSeconds(), tickSize));
                    if (unit == "minute")
                        d.setUTCMinutes(floorInBase(d.getUTCMinutes(), tickSize));
                    if (unit == "hour")
                        d.setUTCHours(floorInBase(d.getUTCHours(), tickSize));
                    if (unit == "month")
                        d.setUTCMonth(floorInBase(d.getUTCMonth(), tickSize));
                    if (unit == "year")
                        d.setUTCFullYear(floorInBase(d.getUTCFullYear(), tickSize));

                    // reset smaller components
                    d.setUTCMilliseconds(0);
                    if (step >= timeUnitSize.minute)
                        d.setUTCSeconds(0);
                    if (step >= timeUnitSize.hour)
                        d.setUTCMinutes(0);
                    if (step >= timeUnitSize.day)
                        d.setUTCHours(0);
                    if (step >= timeUnitSize.day * 4)
                        d.setUTCDate(1);
                    if (step >= timeUnitSize.year)
                        d.setUTCMonth(0);


                    var carry = 0, v = Number.NaN, prev;
                    do {
                        prev = v;
                        v = d.getTime();
                        ticks.push(v);
                        if (unit == "month") {
                            if (tickSize < 1) {
                                // a bit complicated - we'll divide the month
                                // up but we need to take care of fractions
                                // so we don't end up in the middle of a day
                                d.setUTCDate(1);
                                var start = d.getTime();
                                d.setUTCMonth(d.getUTCMonth() + 1);
                                var end = d.getTime();
                                d.setTime(v + carry * timeUnitSize.hour + (end - start) * tickSize);
                                carry = d.getUTCHours();
                                d.setUTCHours(0);
                            }
                            else
                                d.setUTCMonth(d.getUTCMonth() + tickSize);
                        }
                        else if (unit == "year") {
                            d.setUTCFullYear(d.getUTCFullYear() + tickSize);
                        }
                        else
                            d.setTime(v + step);
                    } while (v < axis.max && v != prev);

                    return ticks;
                };

                formatter = function (v, axis) {
                    var d = new Date(v);

                    // first check global format
                    if (opts.timeformat != null)
                        return $.plot.formatDate(d, opts.timeformat, opts.monthNames);

                    var t = axis.tickSize[0] * timeUnitSize[axis.tickSize[1]];
                    var span = axis.max - axis.min;
                    var suffix = (opts.twelveHourClock) ? " %p" : "";

                    if (t < timeUnitSize.minute)
                        fmt = "%h:%M:%S" + suffix;
                    else if (t < timeUnitSize.day) {
                        if (span < 2 * timeUnitSize.day)
                            fmt = "%h:%M" + suffix;
                        else
                            fmt = "%b %d %h:%M" + suffix;
                    }
                    else if (t < timeUnitSize.month)
                        fmt = "%b %d";
                    else if (t < timeUnitSize.year) {
                        if (span < timeUnitSize.year)
                            fmt = "%b";
                        else
                            fmt = "%b %y";
                    }
                    else
                        fmt = "%y";

                    return $.plot.formatDate(d, fmt, opts.monthNames);
                };
            }
            else {
                // pretty rounding of base-10 numbers
                var maxDec = opts.tickDecimals;
                var dec = -Math.floor(Math.log(delta) / Math.LN10);
                if (maxDec != null && dec > maxDec)
                    dec = maxDec;

                magn = Math.pow(10, -dec);
                norm = delta / magn; // norm is between 1.0 and 10.0

                if (norm < 1.5)
                    size = 1;
                else if (norm < 3) {
                    size = 2;
                    // special case for 2.5, requires an extra decimal
                    if (norm > 2.25 && (maxDec == null || dec + 1 <= maxDec)) {
                        size = 2.5;
                        ++dec;
                    }
                }
                else if (norm < 7.5)
                    size = 5;
                else
                    size = 10;

                size *= magn;

                if (opts.minTickSize != null && size < opts.minTickSize)
                    size = opts.minTickSize;

                axis.tickDecimals = Math.max(0, maxDec != null ? maxDec : dec);
                axis.tickSize = opts.tickSize || size;

                generator = function (axis) {
                    var ticks = [];

                    // spew out all possible ticks
                    var start = floorInBase(axis.min, axis.tickSize),
                        i = 0, v = Number.NaN, prev;
                    do {
                        prev = v;
                        v = start + i * axis.tickSize;
                        ticks.push(v);
                        ++i;
                    } while (v < axis.max && v != prev);
                    return ticks;
                };

                formatter = function (v, axis) {
                    return v.toFixed(axis.tickDecimals);
                };
            }

            if (opts.alignTicksWithAxis != null) {
                var otherAxis = (axis.direction == "x" ? xaxes : yaxes)[opts.alignTicksWithAxis - 1];
                if (otherAxis && otherAxis.used && otherAxis != axis) {
                    // consider snapping min/max to outermost nice ticks
                    var niceTicks = generator(axis);
                    if (niceTicks.length > 0) {
                        if (opts.min == null)
                            axis.min = Math.min(axis.min, niceTicks[0]);
                        if (opts.max == null && niceTicks.length > 1)
                            axis.max = Math.max(axis.max, niceTicks[niceTicks.length - 1]);
                    }

                    generator = function (axis) {
                        // copy ticks, scaled to this axis
                        var ticks = [], v, i;
                        for (i = 0; i < otherAxis.ticks.length; ++i) {
                            v = (otherAxis.ticks[i].v - otherAxis.min) / (otherAxis.max - otherAxis.min);
                            v = axis.min + v * (axis.max - axis.min);
                            ticks.push(v);
                        }
                        return ticks;
                    };

                    // we might need an extra decimal since forced
                    // ticks don't necessarily fit naturally
                    if (axis.mode != "time" && opts.tickDecimals == null) {
                        var extraDec = Math.max(0, -Math.floor(Math.log(delta) / Math.LN10) + 1),
                            ts = generator(axis);

                        // only proceed if the tick interval rounded
                        // with an extra decimal doesn't give us a
                        // zero at end
                        if (!(ts.length > 1 && /\..*0$/.test((ts[1] - ts[0]).toFixed(extraDec))))
                            axis.tickDecimals = extraDec;
                    }
                }
            }

            axis.tickGenerator = generator;
            if ($.isFunction(opts.tickFormatter))
                axis.tickFormatter = function (v, axis) {
                    return "" + opts.tickFormatter(v, axis);
                };
            else
                axis.tickFormatter = formatter;
        }

        function setTicks(axis) {
            var oticks = axis.options.ticks, ticks = [];
            if (oticks == null || (typeof oticks == "number" && oticks > 0))
                ticks = axis.tickGenerator(axis);
            else if (oticks) {
                if ($.isFunction(oticks))
                // generate the ticks
                    ticks = oticks({min: axis.min, max: axis.max});
                else
                    ticks = oticks;
            }

            // clean up/labelify the supplied ticks, copy them over
            var i, v;
            axis.ticks = [];
            for (i = 0; i < ticks.length; ++i) {
                var label = null;
                var t = ticks[i];
                if (typeof t == "object") {
                    v = +t[0];
                    if (t.length > 1)
                        label = t[1];
                }
                else
                    v = +t;
                if (label == null)
                    label = axis.tickFormatter(v, axis);
                if (!isNaN(v))
                    axis.ticks.push({v: v, label: label});
            }
        }

        function snapRangeToTicks(axis, ticks) {
            if (axis.options.autoscaleMargin && ticks.length > 0) {
                // snap to ticks
                if (axis.options.min == null)
                    axis.min = Math.min(axis.min, ticks[0].v);
                if (axis.options.max == null && ticks.length > 1)
                    axis.max = Math.max(axis.max, ticks[ticks.length - 1].v);
            }
        }

        function draw() {
            ctx.clearRect(0, 0, canvasWidth, canvasHeight);

            var grid = options.grid;

            // draw background, if any
            if (grid.show && grid.backgroundColor)
                drawBackground();

            if (grid.show && !grid.aboveData)
                drawGrid();

            for (var i = 0; i < series.length; ++i) {
                executeHooks(hooks.drawSeries, [ctx, series[i]]);
                drawSeries(series[i]);
            }

            executeHooks(hooks.draw, [ctx]);

            if (grid.show && grid.aboveData)
                drawGrid();
        }

        function extractRange(ranges, coord) {
            var axis, from, to, key, axes = allAxes();

            for (i = 0; i < axes.length; ++i) {
                axis = axes[i];
                if (axis.direction == coord) {
                    key = coord + axis.n + "axis";
                    if (!ranges[key] && axis.n == 1)
                        key = coord + "axis"; // support x1axis as xaxis
                    if (ranges[key]) {
                        from = ranges[key].from;
                        to = ranges[key].to;
                        break;
                    }
                }
            }

            // backwards-compat stuff - to be removed in future
            if (!ranges[key]) {
                axis = coord == "x" ? xaxes[0] : yaxes[0];
                from = ranges[coord + "1"];
                to = ranges[coord + "2"];
            }

            // auto-reverse as an added bonus
            if (from != null && to != null && from > to) {
                var tmp = from;
                from = to;
                to = tmp;
            }

            return {from: from, to: to, axis: axis};
        }

        function drawBackground() {
            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);

            ctx.fillStyle = getColorOrGradient(options.grid.backgroundColor, plotHeight, 0, "rgba(255, 255, 255, 0)");
            ctx.fillRect(0, 0, plotWidth, plotHeight);
            ctx.restore();
        }

        function drawGrid() {
            var i;

            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);

            // draw markings
            var markings = options.grid.markings;
            if (markings) {
                if ($.isFunction(markings)) {
                    var axes = plot.getAxes();
                    // xmin etc. is backwards compatibility, to be
                    // removed in the future
                    axes.xmin = axes.xaxis.min;
                    axes.xmax = axes.xaxis.max;
                    axes.ymin = axes.yaxis.min;
                    axes.ymax = axes.yaxis.max;

                    markings = markings(axes);
                }

                for (i = 0; i < markings.length; ++i) {
                    var m = markings[i],
                        xrange = extractRange(m, "x"),
                        yrange = extractRange(m, "y");

                    // fill in missing
                    if (xrange.from == null)
                        xrange.from = xrange.axis.min;
                    if (xrange.to == null)
                        xrange.to = xrange.axis.max;
                    if (yrange.from == null)
                        yrange.from = yrange.axis.min;
                    if (yrange.to == null)
                        yrange.to = yrange.axis.max;

                    // clip
                    if (xrange.to < xrange.axis.min || xrange.from > xrange.axis.max ||
                        yrange.to < yrange.axis.min || yrange.from > yrange.axis.max)
                        continue;

                    xrange.from = Math.max(xrange.from, xrange.axis.min);
                    xrange.to = Math.min(xrange.to, xrange.axis.max);
                    yrange.from = Math.max(yrange.from, yrange.axis.min);
                    yrange.to = Math.min(yrange.to, yrange.axis.max);

                    if (xrange.from == xrange.to && yrange.from == yrange.to)
                        continue;

                    // then draw
                    xrange.from = xrange.axis.p2c(xrange.from);
                    xrange.to = xrange.axis.p2c(xrange.to);
                    yrange.from = yrange.axis.p2c(yrange.from);
                    yrange.to = yrange.axis.p2c(yrange.to);

                    if (xrange.from == xrange.to || yrange.from == yrange.to) {
                        // draw line
                        ctx.beginPath();
                        ctx.strokeStyle = m.color || options.grid.markingsColor;
                        ctx.lineWidth = m.lineWidth || options.grid.markingsLineWidth;
                        ctx.moveTo(xrange.from, yrange.from);
                        ctx.lineTo(xrange.to, yrange.to);
                        ctx.stroke();
                    }
                    else {
                        // fill area
                        ctx.fillStyle = m.color || options.grid.markingsColor;
                        ctx.fillRect(xrange.from, yrange.to,
                            xrange.to - xrange.from,
                            yrange.from - yrange.to);
                    }
                }
            }

            // draw the ticks
            var axes = allAxes(), bw = options.grid.borderWidth;

            for (var j = 0; j < axes.length; ++j) {
                var axis = axes[j], box = axis.box,
                    t = axis.tickLength, x, y, xoff, yoff;
                if (!axis.show || axis.ticks.length == 0)
                    continue;

                ctx.strokeStyle = axis.options.tickColor || $.color.parse(axis.options.color).scale('a', 0.22).toString();
                ctx.lineWidth = 1;

                // find the edges
                if (axis.direction == "x") {
                    x = 0;
                    if (t == "full")
                        y = (axis.position == "top" ? 0 : plotHeight);
                    else
                        y = box.top - plotOffset.top + (axis.position == "top" ? box.height : 0);
                }
                else {
                    y = 0;
                    if (t == "full")
                        x = (axis.position == "left" ? 0 : plotWidth);
                    else
                        x = box.left - plotOffset.left + (axis.position == "left" ? box.width : 0);
                }

                // draw tick bar
                if (!axis.innermost) {
                    ctx.beginPath();
                    xoff = yoff = 0;
                    if (axis.direction == "x")
                        xoff = plotWidth;
                    else
                        yoff = plotHeight;

                    if (ctx.lineWidth == 1) {
                        x = Math.floor(x) + 0.5;
                        y = Math.floor(y) + 0.5;
                    }

                    ctx.moveTo(x, y);
                    ctx.lineTo(x + xoff, y + yoff);
                    ctx.stroke();
                }

                // draw ticks
                ctx.beginPath();
                for (i = 0; i < axis.ticks.length; ++i) {
                    var v = axis.ticks[i].v;

                    xoff = yoff = 0;

                    if (v < axis.min || v > axis.max
                            // skip those lying on the axes if we got a border
                        || (t == "full" && bw > 0
                        && (v == axis.min || v == axis.max)))
                        continue;

                    if (axis.direction == "x") {
                        x = axis.p2c(v);
                        yoff = t == "full" ? -plotHeight : t;

                        if (axis.position == "top")
                            yoff = -yoff;
                    }
                    else {
                        y = axis.p2c(v);
                        xoff = t == "full" ? -plotWidth : t;

                        if (axis.position == "left")
                            xoff = -xoff;
                    }

                    if (ctx.lineWidth == 1) {
                        if (axis.direction == "x")
                            x = Math.floor(x) + 0.5;
                        else
                            y = Math.floor(y) + 0.5;
                    }

                    ctx.moveTo(x, y);
                    ctx.lineTo(x + xoff, y + yoff);
                }

                ctx.stroke();
            }


            // draw border
            if (bw) {
                ctx.lineWidth = bw;
                ctx.strokeStyle = options.grid.borderColor;
                ctx.strokeRect(-bw / 2, -bw / 2, plotWidth + bw, plotHeight + bw);
            }

            ctx.restore();
        }

        function insertAxisLabels() {
            placeholder.find(".tickLabels").remove();

            var html = ['<div class="tickLabels" style="font-size:smaller">'];

            var axes = allAxes();
            for (var j = 0; j < axes.length; ++j) {
                var axis = axes[j], box = axis.box;
                if (!axis.show)
                    continue;
                //debug: html.push('<div style="position:absolute;opacity:0.10;background-color:red;left:' + box.left + 'px;top:' + box.top + 'px;width:' + box.width +  'px;height:' + box.height + 'px"></div>')
                html.push('<div class="' + axis.direction + 'Axis ' + axis.direction + axis.n + 'Axis" style="color:' + axis.options.color + '">');
                for (var i = 0; i < axis.ticks.length; ++i) {
                    var tick = axis.ticks[i];
                    if (!tick.label || tick.v < axis.min || tick.v > axis.max)
                        continue;

                    var pos = {}, align;

                    if (axis.direction == "x") {
                        align = "center";
                        pos.left = Math.round(plotOffset.left + axis.p2c(tick.v) - axis.labelWidth / 2);
                        if (axis.position == "bottom")
                            pos.top = box.top + box.padding;
                        else
                            pos.bottom = canvasHeight - (box.top + box.height - box.padding);
                    }
                    else {
                        pos.top = Math.round(plotOffset.top + axis.p2c(tick.v) - axis.labelHeight / 2);
                        if (axis.position == "left") {
                            pos.right = canvasWidth - (box.left + box.width - box.padding);
                            align = "right";
                        }
                        else {
                            pos.left = box.left + box.padding;
                            align = "left";
                        }
                    }

                    pos.width = axis.labelWidth;

                    var style = ["position:absolute", "text-align:" + align];
                    for (var a in pos)
                        style.push(a + ":" + pos[a] + "px")

                    html.push('<div class="tickLabel" style="' + style.join(';') + '">' + tick.label + '</div>');
                }
                html.push('</div>');
            }

            html.push('</div>');

            placeholder.append(html.join(""));
        }

        function drawSeries(series) {
            if (series.lines.show)
                drawSeriesLines(series);
            if (series.bars.show)
                drawSeriesBars(series);
            if (series.points.show)
                drawSeriesPoints(series);
        }

        function drawSeriesLines(series) {
            function plotLine(datapoints, xoffset, yoffset, axisx, axisy) {
                var points = datapoints.points,
                    ps = datapoints.pointsize,
                    prevx = null, prevy = null;

                ctx.beginPath();
                for (var i = ps; i < points.length; i += ps) {
                    var x1 = points[i - ps], y1 = points[i - ps + 1],
                        x2 = points[i], y2 = points[i + 1];

                    if (x1 == null || x2 == null)
                        continue;

                    // clip with ymin
                    if (y1 <= y2 && y1 < axisy.min) {
                        if (y2 < axisy.min)
                            continue;   // line segment is outside
                        // compute new intersection point
                        x1 = (axisy.min - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y1 = axisy.min;
                    }
                    else if (y2 <= y1 && y2 < axisy.min) {
                        if (y1 < axisy.min)
                            continue;
                        x2 = (axisy.min - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y2 = axisy.min;
                    }

                    // clip with ymax
                    if (y1 >= y2 && y1 > axisy.max) {
                        if (y2 > axisy.max)
                            continue;
                        x1 = (axisy.max - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y1 = axisy.max;
                    }
                    else if (y2 >= y1 && y2 > axisy.max) {
                        if (y1 > axisy.max)
                            continue;
                        x2 = (axisy.max - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y2 = axisy.max;
                    }

                    // clip with xmin
                    if (x1 <= x2 && x1 < axisx.min) {
                        if (x2 < axisx.min)
                            continue;
                        y1 = (axisx.min - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x1 = axisx.min;
                    }
                    else if (x2 <= x1 && x2 < axisx.min) {
                        if (x1 < axisx.min)
                            continue;
                        y2 = (axisx.min - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x2 = axisx.min;
                    }

                    // clip with xmax
                    if (x1 >= x2 && x1 > axisx.max) {
                        if (x2 > axisx.max)
                            continue;
                        y1 = (axisx.max - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x1 = axisx.max;
                    }
                    else if (x2 >= x1 && x2 > axisx.max) {
                        if (x1 > axisx.max)
                            continue;
                        y2 = (axisx.max - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x2 = axisx.max;
                    }

                    if (x1 != prevx || y1 != prevy)
                        ctx.moveTo(axisx.p2c(x1) + xoffset, axisy.p2c(y1) + yoffset);

                    prevx = x2;
                    prevy = y2;
                    ctx.lineTo(axisx.p2c(x2) + xoffset, axisy.p2c(y2) + yoffset);
                }
                ctx.stroke();
            }

            function plotLineArea(datapoints, axisx, axisy) {
                var points = datapoints.points,
                    ps = datapoints.pointsize,
                    bottom = Math.min(Math.max(0, axisy.min), axisy.max),
                    i = 0, top, areaOpen = false,
                    ypos = 1, segmentStart = 0, segmentEnd = 0;

                // we process each segment in two turns, first forward
                // direction to sketch out top, then once we hit the
                // end we go backwards to sketch the bottom
                while (true) {
                    if (ps > 0 && i > points.length + ps)
                        break;

                    i += ps; // ps is negative if going backwards

                    var x1 = points[i - ps],
                        y1 = points[i - ps + ypos],
                        x2 = points[i], y2 = points[i + ypos];

                    if (areaOpen) {
                        if (ps > 0 && x1 != null && x2 == null) {
                            // at turning point
                            segmentEnd = i;
                            ps = -ps;
                            ypos = 2;
                            continue;
                        }

                        if (ps < 0 && i == segmentStart + ps) {
                            // done with the reverse sweep
                            ctx.fill();
                            areaOpen = false;
                            ps = -ps;
                            ypos = 1;
                            i = segmentStart = segmentEnd + ps;
                            continue;
                        }
                    }

                    if (x1 == null || x2 == null)
                        continue;

                    // clip x values

                    // clip with xmin
                    if (x1 <= x2 && x1 < axisx.min) {
                        if (x2 < axisx.min)
                            continue;
                        y1 = (axisx.min - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x1 = axisx.min;
                    }
                    else if (x2 <= x1 && x2 < axisx.min) {
                        if (x1 < axisx.min)
                            continue;
                        y2 = (axisx.min - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x2 = axisx.min;
                    }

                    // clip with xmax
                    if (x1 >= x2 && x1 > axisx.max) {
                        if (x2 > axisx.max)
                            continue;
                        y1 = (axisx.max - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x1 = axisx.max;
                    }
                    else if (x2 >= x1 && x2 > axisx.max) {
                        if (x1 > axisx.max)
                            continue;
                        y2 = (axisx.max - x1) / (x2 - x1) * (y2 - y1) + y1;
                        x2 = axisx.max;
                    }

                    if (!areaOpen) {
                        // open area
                        ctx.beginPath();
                        ctx.moveTo(axisx.p2c(x1), axisy.p2c(bottom));
                        areaOpen = true;
                    }

                    // now first check the case where both is outside
                    if (y1 >= axisy.max && y2 >= axisy.max) {
                        ctx.lineTo(axisx.p2c(x1), axisy.p2c(axisy.max));
                        ctx.lineTo(axisx.p2c(x2), axisy.p2c(axisy.max));
                        continue;
                    }
                    else if (y1 <= axisy.min && y2 <= axisy.min) {
                        ctx.lineTo(axisx.p2c(x1), axisy.p2c(axisy.min));
                        ctx.lineTo(axisx.p2c(x2), axisy.p2c(axisy.min));
                        continue;
                    }

                    // else it's a bit more complicated, there might
                    // be a flat maxed out rectangle first, then a
                    // triangular cutout or reverse; to find these
                    // keep track of the current x values
                    var x1old = x1, x2old = x2;

                    // clip the y values, without shortcutting, we
                    // go through all cases in turn

                    // clip with ymin
                    if (y1 <= y2 && y1 < axisy.min && y2 >= axisy.min) {
                        x1 = (axisy.min - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y1 = axisy.min;
                    }
                    else if (y2 <= y1 && y2 < axisy.min && y1 >= axisy.min) {
                        x2 = (axisy.min - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y2 = axisy.min;
                    }

                    // clip with ymax
                    if (y1 >= y2 && y1 > axisy.max && y2 <= axisy.max) {
                        x1 = (axisy.max - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y1 = axisy.max;
                    }
                    else if (y2 >= y1 && y2 > axisy.max && y1 <= axisy.max) {
                        x2 = (axisy.max - y1) / (y2 - y1) * (x2 - x1) + x1;
                        y2 = axisy.max;
                    }

                    // if the x value was changed we got a rectangle
                    // to fill
                    if (x1 != x1old) {
                        ctx.lineTo(axisx.p2c(x1old), axisy.p2c(y1));
                        // it goes to (x1, y1), but we fill that below
                    }

                    // fill triangular section, this sometimes result
                    // in redundant points if (x1, y1) hasn't changed
                    // from previous line to, but we just ignore that
                    ctx.lineTo(axisx.p2c(x1), axisy.p2c(y1));
                    ctx.lineTo(axisx.p2c(x2), axisy.p2c(y2));

                    // fill the other rectangle if it's there
                    if (x2 != x2old) {
                        ctx.lineTo(axisx.p2c(x2), axisy.p2c(y2));
                        ctx.lineTo(axisx.p2c(x2old), axisy.p2c(y2));
                    }
                }
            }

            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);
            ctx.lineJoin = "round";

            var lw = series.lines.lineWidth,
                sw = series.shadowSize;
            // FIXME: consider another form of shadow when filling is turned on
            if (lw > 0 && sw > 0) {
                // draw shadow as a thick and thin line with transparency
                ctx.lineWidth = sw;
                ctx.strokeStyle = "rgba(0,0,0,0.1)";
                // position shadow at angle from the mid of line
                var angle = Math.PI / 18;
                plotLine(series.datapoints, Math.sin(angle) * (lw / 2 + sw / 2), Math.cos(angle) * (lw / 2 + sw / 2), series.xaxis, series.yaxis);
                ctx.lineWidth = sw / 2;
                plotLine(series.datapoints, Math.sin(angle) * (lw / 2 + sw / 4), Math.cos(angle) * (lw / 2 + sw / 4), series.xaxis, series.yaxis);
            }

            ctx.lineWidth = lw;
            ctx.strokeStyle = series.color;
            var fillStyle = getFillStyle(series.lines, series.color, 0, plotHeight);
            if (fillStyle) {
                ctx.fillStyle = fillStyle;
                plotLineArea(series.datapoints, series.xaxis, series.yaxis);
            }

            if (lw > 0)
                plotLine(series.datapoints, 0, 0, series.xaxis, series.yaxis);
            ctx.restore();
        }

        function drawSeriesPoints(series) {
            function plotPoints(datapoints, radius, fillStyle, offset, shadow, axisx, axisy, symbol) {
                var points = datapoints.points, ps = datapoints.pointsize;

                for (var i = 0; i < points.length; i += ps) {
                    var x = points[i], y = points[i + 1];
                    if (x == null || x < axisx.min || x > axisx.max || y < axisy.min || y > axisy.max)
                        continue;

                    ctx.beginPath();
                    x = axisx.p2c(x);
                    y = axisy.p2c(y) + offset;
                    if (symbol == "circle")
                        ctx.arc(x, y, radius, 0, shadow ? Math.PI : Math.PI * 2, false);
                    else
                        symbol(ctx, x, y, radius, shadow);
                    ctx.closePath();

                    if (fillStyle) {
                        ctx.fillStyle = fillStyle;
                        ctx.fill();
                    }
                    ctx.stroke();
                }
            }

            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);

            var lw = series.points.lineWidth,
                sw = series.shadowSize,
                radius = series.points.radius,
                symbol = series.points.symbol;
            if (lw > 0 && sw > 0) {
                // draw shadow in two steps
                var w = sw / 2;
                ctx.lineWidth = w;
                ctx.strokeStyle = "rgba(0,0,0,0.1)";
                plotPoints(series.datapoints, radius, null, w + w / 2, true,
                    series.xaxis, series.yaxis, symbol);

                ctx.strokeStyle = "rgba(0,0,0,0.2)";
                plotPoints(series.datapoints, radius, null, w / 2, true,
                    series.xaxis, series.yaxis, symbol);
            }

            ctx.lineWidth = lw;
            ctx.strokeStyle = series.color;
            plotPoints(series.datapoints, radius,
                getFillStyle(series.points, series.color), 0, false,
                series.xaxis, series.yaxis, symbol);
            ctx.restore();
        }

        function drawBar(x, y, b, barLeft, barRight, offset, fillStyleCallback, axisx, axisy, c, horizontal, lineWidth) {
            var left, right, bottom, top,
                drawLeft, drawRight, drawTop, drawBottom,
                tmp;

            // in horizontal mode, we start the bar from the left
            // instead of from the bottom so it appears to be
            // horizontal rather than vertical
            if (horizontal) {
                drawBottom = drawRight = drawTop = true;
                drawLeft = false;
                left = b;
                right = x;
                top = y + barLeft;
                bottom = y + barRight;

                // account for negative bars
                if (right < left) {
                    tmp = right;
                    right = left;
                    left = tmp;
                    drawLeft = true;
                    drawRight = false;
                }
            }
            else {
                drawLeft = drawRight = drawTop = true;
                drawBottom = false;
                left = x + barLeft;
                right = x + barRight;
                bottom = b;
                top = y;

                // account for negative bars
                if (top < bottom) {
                    tmp = top;
                    top = bottom;
                    bottom = tmp;
                    drawBottom = true;
                    drawTop = false;
                }
            }

            // clip
            if (right < axisx.min || left > axisx.max ||
                top < axisy.min || bottom > axisy.max)
                return;

            if (left < axisx.min) {
                left = axisx.min;
                drawLeft = false;
            }

            if (right > axisx.max) {
                right = axisx.max;
                drawRight = false;
            }

            if (bottom < axisy.min) {
                bottom = axisy.min;
                drawBottom = false;
            }

            if (top > axisy.max) {
                top = axisy.max;
                drawTop = false;
            }

            left = axisx.p2c(left);
            bottom = axisy.p2c(bottom);
            right = axisx.p2c(right);
            top = axisy.p2c(top);

            // fill the bar
            if (fillStyleCallback) {
                c.beginPath();
                c.moveTo(left, bottom);
                c.lineTo(left, top);
                c.lineTo(right, top);
                c.lineTo(right, bottom);
                c.fillStyle = fillStyleCallback(bottom, top);
                c.fill();
            }

            // draw outline
            if (lineWidth > 0 && (drawLeft || drawRight || drawTop || drawBottom)) {
                c.beginPath();

                // FIXME: inline moveTo is buggy with excanvas
                c.moveTo(left, bottom + offset);
                if (drawLeft)
                    c.lineTo(left, top + offset);
                else
                    c.moveTo(left, top + offset);
                if (drawTop)
                    c.lineTo(right, top + offset);
                else
                    c.moveTo(right, top + offset);
                if (drawRight)
                    c.lineTo(right, bottom + offset);
                else
                    c.moveTo(right, bottom + offset);
                if (drawBottom)
                    c.lineTo(left, bottom + offset);
                else
                    c.moveTo(left, bottom + offset);
                c.stroke();
            }
        }

        function drawSeriesBars(series) {
            function plotBars(datapoints, barLeft, barRight, offset, fillStyleCallback, axisx, axisy) {
                var points = datapoints.points, ps = datapoints.pointsize;

                for (var i = 0; i < points.length; i += ps) {
                    if (points[i] == null)
                        continue;
                    drawBar(points[i], points[i + 1], points[i + 2], barLeft, barRight, offset, fillStyleCallback, axisx, axisy, ctx, series.bars.horizontal, series.bars.lineWidth);
                }
            }

            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);

            // FIXME: figure out a way to add shadows (for instance along the right edge)
            ctx.lineWidth = series.bars.lineWidth;
            ctx.strokeStyle = series.color;
            var barLeft = series.bars.align == "left" ? 0 : -series.bars.barWidth / 2;
            var fillStyleCallback = series.bars.fill ? function (bottom, top) {
                return getFillStyle(series.bars, series.color, bottom, top);
            } : null;
            plotBars(series.datapoints, barLeft, barLeft + series.bars.barWidth, 0, fillStyleCallback, series.xaxis, series.yaxis);
            ctx.restore();
        }

        function getFillStyle(filloptions, seriesColor, bottom, top) {
            var fill = filloptions.fill;
            if (!fill)
                return null;

            if (filloptions.fillColor)
                return getColorOrGradient(filloptions.fillColor, bottom, top, seriesColor);

            var c = $.color.parse(seriesColor);
            c.a = typeof fill == "number" ? fill : 0.4;
            c.normalize();
            return c.toString();
        }

        function insertLegend() {
            placeholder.find(".legend").remove();

            if (!options.legend.show)
                return;

            var fragments = [], rowStarted = false,
                lf = options.legend.labelFormatter, s, label;
            for (var i = 0; i < series.length; ++i) {
                s = series[i];
                label = s.label;
                if (!label)
                    continue;

                if (i % options.legend.noColumns == 0) {
                    if (rowStarted)
                        fragments.push('</tr>');
                    fragments.push('<tr>');
                    rowStarted = true;
                }

                if (lf)
                    label = lf(label, s);

                fragments.push(
                    '<td class="legendColorBox"><div style="border:1px solid ' + options.legend.labelBoxBorderColor + ';padding:1px"><div style="width:4px;height:0;border:5px solid ' + s.color + ';overflow:hidden"></div></div></td>' +
                    '<td class="legendLabel">' + label + '</td>');
            }
            if (rowStarted)
                fragments.push('</tr>');

            if (fragments.length == 0)
                return;

            var table = '<table style="font-size:smaller;color:' + options.grid.color + '">' + fragments.join("") + '</table>';
            if (options.legend.container != null)
                $(options.legend.container).html(table);
            else {
                var pos = "",
                    p = options.legend.position,
                    m = options.legend.margin;
                if (m[0] == null)
                    m = [m, m];
                if (p.charAt(0) == "n")
                    pos += 'top:' + (m[1] + plotOffset.top) + 'px;';
                else if (p.charAt(0) == "s")
                    pos += 'bottom:' + (m[1] + plotOffset.bottom) + 'px;';
                if (p.charAt(1) == "e")
                    pos += 'right:' + (m[0] + plotOffset.right) + 'px;';
                else if (p.charAt(1) == "w")
                    pos += 'left:' + (m[0] + plotOffset.left) + 'px;';
                var legend = $('<div class="legend">' + table.replace('style="', 'style="position:absolute;' + pos + ';') + '</div>').appendTo(placeholder);
                if (options.legend.backgroundOpacity != 0.0) {
                    // put in the transparent background
                    // separately to avoid blended labels and
                    // label boxes
                    var c = options.legend.backgroundColor;
                    if (c == null) {
                        c = options.grid.backgroundColor;
                        if (c && typeof c == "string")
                            c = $.color.parse(c);
                        else
                            c = $.color.extract(legend, 'background-color');
                        c.a = 1;
                        c = c.toString();
                    }
                    var div = legend.children();
                    $('<div style="position:absolute;width:' + div.width() + 'px;height:' + div.height() + 'px;' + pos + 'background-color:' + c + ';"> </div>').prependTo(legend).css('opacity', options.legend.backgroundOpacity);
                }
            }
        }


        // interactive features

        var highlights = [],
            redrawTimeout = null;

        // returns the data item the mouse is over, or null if none is found
        function findNearbyItem(mouseX, mouseY, seriesFilter) {
            var maxDistance = options.grid.mouseActiveRadius,
                smallestDistance = maxDistance * maxDistance + 1,
                item = null, foundPoint = false, i, j;

            for (i = series.length - 1; i >= 0; --i) {
                if (!seriesFilter(series[i]))
                    continue;

                var s = series[i],
                    axisx = s.xaxis,
                    axisy = s.yaxis,
                    points = s.datapoints.points,
                    ps = s.datapoints.pointsize,
                    mx = axisx.c2p(mouseX), // precompute some stuff to make the loop faster
                    my = axisy.c2p(mouseY),
                    maxx = maxDistance / axisx.scale,
                    maxy = maxDistance / axisy.scale;

                // with inverse transforms, we can't use the maxx/maxy
                // optimization, sadly
                if (axisx.options.inverseTransform)
                    maxx = Number.MAX_VALUE;
                if (axisy.options.inverseTransform)
                    maxy = Number.MAX_VALUE;

                if (s.lines.show || s.points.show) {
                    for (j = 0; j < points.length; j += ps) {
                        var x = points[j], y = points[j + 1];
                        if (x == null)
                            continue;

                        // For points and lines, the cursor must be within a
                        // certain distance to the data point
                        if (x - mx > maxx || x - mx < -maxx ||
                            y - my > maxy || y - my < -maxy)
                            continue;

                        // We have to calculate distances in pixels, not in
                        // data units, because the scales of the axes may be different
                        var dx = Math.abs(axisx.p2c(x) - mouseX),
                            dy = Math.abs(axisy.p2c(y) - mouseY),
                            dist = dx * dx + dy * dy; // we save the sqrt

                        // use <= to ensure last point takes precedence
                        // (last generally means on top of)
                        if (dist < smallestDistance) {
                            smallestDistance = dist;
                            item = [i, j / ps];
                        }
                    }
                }

                if (s.bars.show && !item) { // no other point can be nearby
                    var barLeft = s.bars.align == "left" ? 0 : -s.bars.barWidth / 2,
                        barRight = barLeft + s.bars.barWidth;

                    for (j = 0; j < points.length; j += ps) {
                        var x = points[j], y = points[j + 1], b = points[j + 2];
                        if (x == null)
                            continue;

                        // for a bar graph, the cursor must be inside the bar
                        if (series[i].bars.horizontal ?
                                (mx <= Math.max(b, x) && mx >= Math.min(b, x) &&
                                my >= y + barLeft && my <= y + barRight) :
                                (mx >= x + barLeft && mx <= x + barRight &&
                                my >= Math.min(b, y) && my <= Math.max(b, y)))
                            item = [i, j / ps];
                    }
                }
            }

            if (item) {
                i = item[0];
                j = item[1];
                ps = series[i].datapoints.pointsize;

                return {
                    datapoint: series[i].datapoints.points.slice(j * ps, (j + 1) * ps),
                    dataIndex: j,
                    series: series[i],
                    seriesIndex: i
                };
            }

            return null;
        }

        function onMouseMove(e) {
            if (options.grid.hoverable)
                triggerClickHoverEvent("plothover", e,
                    function (s) {
                        return s["hoverable"] != false;
                    });
        }

        function onMouseLeave(e) {
            if (options.grid.hoverable)
                triggerClickHoverEvent("plothover", e,
                    function (s) {
                        return false;
                    });
        }

        function onClick(e) {
            triggerClickHoverEvent("plotclick", e,
                function (s) {
                    return s["clickable"] != false;
                });
        }

        // trigger click or hover event (they send the same parameters
        // so we share their code)
        function triggerClickHoverEvent(eventname, event, seriesFilter) {
            var offset = eventHolder.offset(),
                canvasX = event.pageX - offset.left - plotOffset.left,
                canvasY = event.pageY - offset.top - plotOffset.top,
                pos = canvasToAxisCoords({left: canvasX, top: canvasY});

            pos.pageX = event.pageX;
            pos.pageY = event.pageY;

            var item = findNearbyItem(canvasX, canvasY, seriesFilter);

            if (item) {
                // fill in mouse pos for any listeners out there
                item.pageX = parseInt(item.series.xaxis.p2c(item.datapoint[0]) + offset.left + plotOffset.left);
                item.pageY = parseInt(item.series.yaxis.p2c(item.datapoint[1]) + offset.top + plotOffset.top);
            }

            if (options.grid.autoHighlight) {
                // clear auto-highlights
                for (var i = 0; i < highlights.length; ++i) {
                    var h = highlights[i];
                    if (h.auto == eventname && !(item && h.series == item.series &&
                        h.point[0] == item.datapoint[0] &&
                        h.point[1] == item.datapoint[1]))
                        unhighlight(h.series, h.point);
                }

                if (item)
                    highlight(item.series, item.datapoint, eventname);
            }

            placeholder.trigger(eventname, [pos, item]);
        }

        function triggerRedrawOverlay() {
            if (!redrawTimeout)
                redrawTimeout = setTimeout(drawOverlay, 30);
        }

        function drawOverlay() {
            redrawTimeout = null;

            // draw highlights
            octx.save();
            octx.clearRect(0, 0, canvasWidth, canvasHeight);
            octx.translate(plotOffset.left, plotOffset.top);

            var i, hi;
            for (i = 0; i < highlights.length; ++i) {
                hi = highlights[i];

                if (hi.series.bars.show)
                    drawBarHighlight(hi.series, hi.point);
                else
                    drawPointHighlight(hi.series, hi.point);
            }
            octx.restore();

            executeHooks(hooks.drawOverlay, [octx]);
        }

        function highlight(s, point, auto) {
            if (typeof s == "number")
                s = series[s];

            if (typeof point == "number") {
                var ps = s.datapoints.pointsize;
                point = s.datapoints.points.slice(ps * point, ps * (point + 1));
            }

            var i = indexOfHighlight(s, point);
            if (i == -1) {
                highlights.push({series: s, point: point, auto: auto});

                triggerRedrawOverlay();
            }
            else if (!auto)
                highlights[i].auto = false;
        }

        function unhighlight(s, point) {
            if (s == null && point == null) {
                highlights = [];
                triggerRedrawOverlay();
            }

            if (typeof s == "number")
                s = series[s];

            if (typeof point == "number")
                point = s.data[point];

            var i = indexOfHighlight(s, point);
            if (i != -1) {
                highlights.splice(i, 1);

                triggerRedrawOverlay();
            }
        }

        function indexOfHighlight(s, p) {
            for (var i = 0; i < highlights.length; ++i) {
                var h = highlights[i];
                if (h.series == s && h.point[0] == p[0]
                    && h.point[1] == p[1])
                    return i;
            }
            return -1;
        }

        function drawPointHighlight(series, point) {
            var x = point[0], y = point[1],
                axisx = series.xaxis, axisy = series.yaxis;

            if (x < axisx.min || x > axisx.max || y < axisy.min || y > axisy.max)
                return;

            var pointRadius = series.points.radius + series.points.lineWidth / 2;
            octx.lineWidth = pointRadius;
            octx.strokeStyle = $.color.parse(series.color).scale('a', 0.5).toString();
            var radius = 1.5 * pointRadius,
                x = axisx.p2c(x),
                y = axisy.p2c(y);

            octx.beginPath();
            if (series.points.symbol == "circle")
                octx.arc(x, y, radius, 0, 2 * Math.PI, false);
            else
                series.points.symbol(octx, x, y, radius, false);
            octx.closePath();
            octx.stroke();
        }

        function drawBarHighlight(series, point) {
            octx.lineWidth = series.bars.lineWidth;
            octx.strokeStyle = $.color.parse(series.color).scale('a', 0.5).toString();
            var fillStyle = $.color.parse(series.color).scale('a', 0.5).toString();
            var barLeft = series.bars.align == "left" ? 0 : -series.bars.barWidth / 2;
            drawBar(point[0], point[1], point[2] || 0, barLeft, barLeft + series.bars.barWidth,
                0, function () {
                    return fillStyle;
                }, series.xaxis, series.yaxis, octx, series.bars.horizontal, series.bars.lineWidth);
        }

        function getColorOrGradient(spec, bottom, top, defaultColor) {
            if (typeof spec == "string")
                return spec;
            else {
                // assume this is a gradient spec; IE currently only
                // supports a simple vertical gradient properly, so that's
                // what we support too
                var gradient = ctx.createLinearGradient(0, top, 0, bottom);

                for (var i = 0, l = spec.colors.length; i < l; ++i) {
                    var c = spec.colors[i];
                    if (typeof c != "string") {
                        var co = $.color.parse(defaultColor);
                        if (c.brightness != null)
                            co = co.scale('rgb', c.brightness);
                        if (c.opacity != null)
                            co.a *= c.opacity;
                        c = co.toString();
                    }
                    gradient.addColorStop(i / (l - 1), c);
                }

                return gradient;
            }
        }
    }

    $.plot = function (placeholder, data, options) {
        //var t0 = new Date();
        var plot = new Plot($(placeholder), data, options, $.plot.plugins);
        //(window.console ? console.log : alert)("time used (msecs): " + ((new Date()).getTime() - t0.getTime()));
        return plot;
    };

    $.plot.version = "0.7";

    $.plot.plugins = [];

    // returns a string with the date d formatted according to fmt
    $.plot.formatDate = function (d, fmt, monthNames) {
        var leftPad = function (n) {
            n = "" + n;
            return n.length == 1 ? "0" + n : n;
        };

        var r = [];
        var escape = false, padNext = false;
        var hours = d.getUTCHours();
        var isAM = hours < 12;
        if (monthNames == null)
            monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        if (fmt.search(/%p|%P/) != -1) {
            if (hours > 12) {
                hours = hours - 12;
            } else if (hours == 0) {
                hours = 12;
            }
        }
        for (var i = 0; i < fmt.length; ++i) {
            var c = fmt.charAt(i);

            if (escape) {
                switch (c) {
                    case 'h':
                        c = "" + hours;
                        break;
                    case 'H':
                        c = leftPad(hours);
                        break;
                    case 'M':
                        c = leftPad(d.getUTCMinutes());
                        break;
                    case 'S':
                        c = leftPad(d.getUTCSeconds());
                        break;
                    case 'd':
                        c = "" + d.getUTCDate();
                        break;
                    case 'm':
                        c = "" + (d.getUTCMonth() + 1);
                        break;
                    case 'y':
                        c = "" + d.getUTCFullYear();
                        break;
                    case 'b':
                        c = "" + monthNames[d.getUTCMonth()];
                        break;
                    case 'p':
                        c = (isAM) ? ("" + "am") : ("" + "pm");
                        break;
                    case 'P':
                        c = (isAM) ? ("" + "AM") : ("" + "PM");
                        break;
                    case '0':
                        c = "";
                        padNext = true;
                        break;
                }
                if (c && padNext) {
                    c = leftPad(c);
                    padNext = false;
                }
                r.push(c);
                if (!padNext)
                    escape = false;
            }
            else {
                if (c == "%")
                    escape = true;
                else
                    r.push(c);
            }
        }
        return r.join("");
    };

    // round to nearby lower multiple of base
    function floorInBase(n, base) {
        return base * Math.floor(n / base);
    }

})(jQuery);

/*
 Flot plugin for rendering pie charts. The plugin assumes the data is
 coming is as a single data value for each series, and each of those
 values is a positive value or zero (negative numbers don't make
 any sense and will cause strange effects). The data values do
 NOT need to be passed in as percentage values because it
 internally calculates the total and percentages.

 * Created by Brian Medendorp, June 2009
 * Updated November 2009 with contributions from: btburnett3, Anthony Aragues and Xavi Ivars

 * Changes:
 2009-10-22: lineJoin set to round
 2009-10-23: IE full circle fix, donut
 2009-11-11: Added basic hover from btburnett3 - does not work in IE, and center is off in Chrome and Opera
 2009-11-17: Added IE hover capability submitted by Anthony Aragues
 2009-11-18: Added bug fix submitted by Xavi Ivars (issues with arrays when other JS libraries are included as well)


 Available options are:
 series: {
 pie: {
 show: true/false
 radius: 0-1 for percentage of fullsize, or a specified pixel length, or 'auto'
 innerRadius: 0-1 for percentage of fullsize or a specified pixel length, for creating a donut effect
 startAngle: 0-2 factor of PI used for starting angle (in radians) i.e 3/2 starts at the top, 0 and 2 have the same result
 tilt: 0-1 for percentage to tilt the pie, where 1 is no tilt, and 0 is completely flat (nothing will show)
 offset: {
 top: integer value to move the pie up or down
 left: integer value to move the pie left or right, or 'auto'
 },
 stroke: {
 color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#FFF')
 width: integer pixel width of the stroke
 },
 label: {
 show: true/false, or 'auto'
 formatter:  a user-defined function that modifies the text/style of the label text
 radius: 0-1 for percentage of fullsize, or a specified pixel length
 background: {
 color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#000')
 opacity: 0-1
 },
 threshold: 0-1 for the percentage value at which to hide labels (if they're too small)
 },
 combine: {
 threshold: 0-1 for the percentage value at which to combine slices (if they're too small)
 color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#CCC'), if null, the plugin will automatically use the color of the first slice to be combined
 label: any text value of what the combined slice should be labeled
 }
 highlight: {
 opacity: 0-1
 }
 }
 }

 More detail and specific examples can be found in the included HTML file.

 */

(function ($) {
    function init(plot) // this is the "body" of the plugin
    {
        var canvas = null;
        var target = null;
        var maxRadius = null;
        var centerLeft = null;
        var centerTop = null;
        var total = 0;
        var redraw = true;
        var redrawAttempts = 10;
        var shrink = 0.95;
        var legendWidth = 0;
        var processed = false;
        var raw = false;

        // interactive variables
        var highlights = [];

        // add hook to determine if pie plugin in enabled, and then perform necessary operations
        plot.hooks.processOptions.push(checkPieEnabled);
        plot.hooks.bindEvents.push(bindEvents);

        // check to see if the pie plugin is enabled
        function checkPieEnabled(plot, options) {
            if (options.series.pie.show) {
                //disable grid
                options.grid.show = false;

                // set labels.show
                if (options.series.pie.label.show == 'auto')
                    if (options.legend.show)
                        options.series.pie.label.show = false;
                    else
                        options.series.pie.label.show = true;

                // set radius
                if (options.series.pie.radius == 'auto')
                    if (options.series.pie.label.show)
                        options.series.pie.radius = 3 / 4;
                    else
                        options.series.pie.radius = 1;

                // ensure sane tilt
                if (options.series.pie.tilt > 1)
                    options.series.pie.tilt = 1;
                if (options.series.pie.tilt < 0)
                    options.series.pie.tilt = 0;

                // add processData hook to do transformations on the data
                plot.hooks.processDatapoints.push(processDatapoints);
                plot.hooks.drawOverlay.push(drawOverlay);

                // add draw hook
                plot.hooks.draw.push(draw);
            }
        }

        // bind hoverable events
        function bindEvents(plot, eventHolder) {
            var options = plot.getOptions();

            if (options.series.pie.show && options.grid.hoverable)
                eventHolder.unbind('mousemove').mousemove(onMouseMove);

            if (options.series.pie.show && options.grid.clickable)
                eventHolder.unbind('click').click(onClick);
        }


        // debugging function that prints out an object
        function alertObject(obj) {
            var msg = '';

            function traverse(obj, depth) {
                if (!depth)
                    depth = 0;
                for (var i = 0; i < obj.length; ++i) {
                    for (var j = 0; j < depth; j++)
                        msg += '\t';

                    if (typeof obj[i] == "object") {	// its an object
                        msg += '' + i + ':\n';
                        traverse(obj[i], depth + 1);
                    }
                    else {	// its a value
                        msg += '' + i + ': ' + obj[i] + '\n';
                    }
                }
            }

            traverse(obj);
            alert(msg);
        }

        function calcTotal(data) {
            for (var i = 0; i < data.length; ++i) {
                var item = parseFloat(data[i].data[0][1]);
                if (item)
                    total += item;
            }
        }

        function processDatapoints(plot, series, data, datapoints) {
            if (!processed) {
                processed = true;

                canvas = plot.getCanvas();
                target = $(canvas).parent();
                options = plot.getOptions();

                plot.setData(combine(plot.getData()));
            }
        }

        function setupPie() {
            legendWidth = target.children().filter('.legend').children().width();

            // calculate maximum radius and center point
            maxRadius = Math.min(canvas.width, (canvas.height / options.series.pie.tilt)) / 2;
            centerTop = (canvas.height / 2) + options.series.pie.offset.top;
            centerLeft = (canvas.width / 2);

            if (options.series.pie.offset.left == 'auto')
                if (options.legend.position.match('w'))
                    centerLeft += legendWidth / 2;
                else
                    centerLeft -= legendWidth / 2;
            else
                centerLeft += options.series.pie.offset.left;

            if (centerLeft < maxRadius)
                centerLeft = maxRadius;
            else if (centerLeft > canvas.width - maxRadius)
                centerLeft = canvas.width - maxRadius;
        }

        function fixData(data) {
            for (var i = 0; i < data.length; ++i) {
                if (typeof(data[i].data) == 'number')
                    data[i].data = [[1, data[i].data]];
                else if (typeof(data[i].data) == 'undefined' || typeof(data[i].data[0]) == 'undefined') {
                    if (typeof(data[i].data) != 'undefined' && typeof(data[i].data.label) != 'undefined')
                        data[i].label = data[i].data.label; // fix weirdness coming from flot
                    data[i].data = [[1, 0]];

                }
            }
            return data;
        }

        function combine(data) {
            data = fixData(data);
            calcTotal(data);
            var combined = 0;
            var numCombined = 0;
            var color = options.series.pie.combine.color;

            var newdata = [];
            for (var i = 0; i < data.length; ++i) {
                // make sure its a number
                data[i].data[0][1] = parseFloat(data[i].data[0][1]);
                if (!data[i].data[0][1])
                    data[i].data[0][1] = 0;

                if (data[i].data[0][1] / total <= options.series.pie.combine.threshold) {
                    combined += data[i].data[0][1];
                    numCombined++;
                    if (!color)
                        color = data[i].color;
                }
                else {
                    newdata.push({
                        data: [[1, data[i].data[0][1]]],
                        color: data[i].color,
                        label: data[i].label,
                        angle: (data[i].data[0][1] * (Math.PI * 2)) / total,
                        percent: (data[i].data[0][1] / total * 100)
                    });
                }
            }
            if (numCombined > 0)
                newdata.push({
                    data: [[1, combined]],
                    color: color,
                    label: options.series.pie.combine.label,
                    angle: (combined * (Math.PI * 2)) / total,
                    percent: (combined / total * 100)
                });
            return newdata;
        }

        function draw(plot, newCtx) {
            if (!target) return; // if no series were passed
            ctx = newCtx;

            setupPie();
            var slices = plot.getData();

            var attempts = 0;
            while (redraw && attempts < redrawAttempts) {
                redraw = false;
                if (attempts > 0)
                    maxRadius *= shrink;
                attempts += 1;
                clear();
                if (options.series.pie.tilt <= 0.8)
                    drawShadow();
                drawPie();
            }
            if (attempts >= redrawAttempts) {
                clear();
                target.prepend('<div class="error">Could not draw pie with labels contained inside canvas</div>');
            }

            if (plot.setSeries && plot.insertLegend) {
                plot.setSeries(slices);
                plot.insertLegend();
            }

            // we're actually done at this point, just defining internal functions at this point

            function clear() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                target.children().filter('.pieLabel, .pieLabelBackground').remove();
            }

            function drawShadow() {
                var shadowLeft = 5;
                var shadowTop = 15;
                var edge = 10;
                var alpha = 0.02;

                // set radius
                if (options.series.pie.radius > 1)
                    var radius = options.series.pie.radius;
                else
                    var radius = maxRadius * options.series.pie.radius;

                if (radius >= (canvas.width / 2) - shadowLeft || radius * options.series.pie.tilt >= (canvas.height / 2) - shadowTop || radius <= edge)
                    return;	// shadow would be outside canvas, so don't draw it

                ctx.save();
                ctx.translate(shadowLeft, shadowTop);
                ctx.globalAlpha = alpha;
                ctx.fillStyle = '#000';

                // center and rotate to starting position
                ctx.translate(centerLeft, centerTop);
                ctx.scale(1, options.series.pie.tilt);

                //radius -= edge;
                for (var i = 1; i <= edge; i++) {
                    ctx.beginPath();
                    ctx.arc(0, 0, radius, 0, Math.PI * 2, false);
                    ctx.fill();
                    radius -= i;
                }

                ctx.restore();
            }

            function drawPie() {
                startAngle = Math.PI * options.series.pie.startAngle;

                // set radius
                if (options.series.pie.radius > 1)
                    var radius = options.series.pie.radius;
                else
                    var radius = maxRadius * options.series.pie.radius;

                // center and rotate to starting position
                ctx.save();
                ctx.translate(centerLeft, centerTop);
                ctx.scale(1, options.series.pie.tilt);
                //ctx.rotate(startAngle); // start at top; -- This doesn't work properly in Opera

                // draw slices
                ctx.save();
                var currentAngle = startAngle;
                for (var i = 0; i < slices.length; ++i) {
                    slices[i].startAngle = currentAngle;
                    drawSlice(slices[i].angle, slices[i].color, true);
                }
                ctx.restore();

                // draw slice outlines
                ctx.save();
                ctx.lineWidth = options.series.pie.stroke.width;
                currentAngle = startAngle;
                for (var i = 0; i < slices.length; ++i)
                    drawSlice(slices[i].angle, options.series.pie.stroke.color, false);
                ctx.restore();

                // draw donut hole
                drawDonutHole(ctx);

                // draw labels
                if (options.series.pie.label.show)
                    drawLabels();

                // restore to original state
                ctx.restore();

                function drawSlice(angle, color, fill) {
                    if (angle <= 0)
                        return;

                    if (fill)
                        ctx.fillStyle = color;
                    else {
                        ctx.strokeStyle = color;
                        ctx.lineJoin = 'round';
                    }

                    ctx.beginPath();
                    if (Math.abs(angle - Math.PI * 2) > 0.000000001)
                        ctx.moveTo(0, 0); // Center of the pie
                    else if ($.browser.msie)
                        angle -= 0.0001;
                    //ctx.arc(0,0,radius,0,angle,false); // This doesn't work properly in Opera
                    ctx.arc(0, 0, radius, currentAngle, currentAngle + angle, false);
                    ctx.closePath();
                    //ctx.rotate(angle); // This doesn't work properly in Opera
                    currentAngle += angle;

                    if (fill)
                        ctx.fill();
                    else
                        ctx.stroke();
                }

                function drawLabels() {
                    var currentAngle = startAngle;

                    // set radius
                    if (options.series.pie.label.radius > 1)
                        var radius = options.series.pie.label.radius;
                    else
                        var radius = maxRadius * options.series.pie.label.radius;

                    for (var i = 0; i < slices.length; ++i) {
                        if (slices[i].percent >= options.series.pie.label.threshold * 100)
                            drawLabel(slices[i], currentAngle, i);
                        currentAngle += slices[i].angle;
                    }

                    function drawLabel(slice, startAngle, index) {
                        if (slice.data[0][1] == 0)
                            return;

                        // format label text
                        var lf = options.legend.labelFormatter, text, plf = options.series.pie.label.formatter;
                        if (lf)
                            text = lf(slice.label, slice);
                        else
                            text = slice.label;
                        if (plf)
                            text = plf(text, slice);

                        var halfAngle = ((startAngle + slice.angle) + startAngle) / 2;
                        var x = centerLeft + Math.round(Math.cos(halfAngle) * radius);
                        var y = centerTop + Math.round(Math.sin(halfAngle) * radius) * options.series.pie.tilt;

                        var html = '<span class="pieLabel" id="pieLabel' + index + '" style="position:absolute;top:' + y + 'px;left:' + x + 'px;">' + text + "</span>";
                        target.append(html);
                        var label = target.children('#pieLabel' + index);
                        var labelTop = (y - label.height() / 2);
                        var labelLeft = (x - label.width() / 2);
                        label.css('top', labelTop);
                        label.css('left', labelLeft);

                        // check to make sure that the label is not outside the canvas
                        if (0 - labelTop > 0 || 0 - labelLeft > 0 || canvas.height - (labelTop + label.height()) < 0 || canvas.width - (labelLeft + label.width()) < 0)
                            redraw = true;

                        if (options.series.pie.label.background.opacity != 0) {
                            // put in the transparent background separately to avoid blended labels and label boxes
                            var c = options.series.pie.label.background.color;
                            if (c == null) {
                                c = slice.color;
                            }
                            var pos = 'top:' + labelTop + 'px;left:' + labelLeft + 'px;';
                            $('<div class="pieLabelBackground" style="position:absolute;width:' + label.width() + 'px;height:' + label.height() + 'px;' + pos + 'background-color:' + c + ';"> </div>').insertBefore(label).css('opacity', options.series.pie.label.background.opacity);
                        }
                    } // end individual label function
                } // end drawLabels function
            } // end drawPie function
        } // end draw function

        // Placed here because it needs to be accessed from multiple locations
        function drawDonutHole(layer) {
            // draw donut hole
            if (options.series.pie.innerRadius > 0) {
                // subtract the center
                layer.save();
                innerRadius = options.series.pie.innerRadius > 1 ? options.series.pie.innerRadius : maxRadius * options.series.pie.innerRadius;
                layer.globalCompositeOperation = 'destination-out'; // this does not work with excanvas, but it will fall back to using the stroke color
                layer.beginPath();
                layer.fillStyle = options.series.pie.stroke.color;
                layer.arc(0, 0, innerRadius, 0, Math.PI * 2, false);
                layer.fill();
                layer.closePath();
                layer.restore();

                // add inner stroke
                layer.save();
                layer.beginPath();
                layer.strokeStyle = options.series.pie.stroke.color;
                layer.arc(0, 0, innerRadius, 0, Math.PI * 2, false);
                layer.stroke();
                layer.closePath();
                layer.restore();
                // TODO: add extra shadow inside hole (with a mask) if the pie is tilted.
            }
        }

        //-- Additional Interactive related functions --

        function isPointInPoly(poly, pt) {
            for (var c = false, i = -1, l = poly.length, j = l - 1; ++i < l; j = i)
                ((poly[i][1] <= pt[1] && pt[1] < poly[j][1]) || (poly[j][1] <= pt[1] && pt[1] < poly[i][1]))
                && (pt[0] < (poly[j][0] - poly[i][0]) * (pt[1] - poly[i][1]) / (poly[j][1] - poly[i][1]) + poly[i][0])
                && (c = !c);
            return c;
        }

        function findNearbySlice(mouseX, mouseY) {
            var slices = plot.getData(),
                options = plot.getOptions(),
                radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius;

            for (var i = 0; i < slices.length; ++i) {
                var s = slices[i];

                if (s.pie.show) {
                    ctx.save();
                    ctx.beginPath();
                    ctx.moveTo(0, 0); // Center of the pie
                    //ctx.scale(1, options.series.pie.tilt);	// this actually seems to break everything when here.
                    ctx.arc(0, 0, radius, s.startAngle, s.startAngle + s.angle, false);
                    ctx.closePath();
                    x = mouseX - centerLeft;
                    y = mouseY - centerTop;
                    if (ctx.isPointInPath) {
                        if (ctx.isPointInPath(mouseX - centerLeft, mouseY - centerTop)) {
                            //alert('found slice!');
                            ctx.restore();
                            return {datapoint: [s.percent, s.data], dataIndex: 0, series: s, seriesIndex: i};
                        }
                    }
                    else {
                        // excanvas for IE doesn;t support isPointInPath, this is a workaround.
                        p1X = (radius * Math.cos(s.startAngle));
                        p1Y = (radius * Math.sin(s.startAngle));
                        p2X = (radius * Math.cos(s.startAngle + (s.angle / 4)));
                        p2Y = (radius * Math.sin(s.startAngle + (s.angle / 4)));
                        p3X = (radius * Math.cos(s.startAngle + (s.angle / 2)));
                        p3Y = (radius * Math.sin(s.startAngle + (s.angle / 2)));
                        p4X = (radius * Math.cos(s.startAngle + (s.angle / 1.5)));
                        p4Y = (radius * Math.sin(s.startAngle + (s.angle / 1.5)));
                        p5X = (radius * Math.cos(s.startAngle + s.angle));
                        p5Y = (radius * Math.sin(s.startAngle + s.angle));
                        arrPoly = [[0, 0], [p1X, p1Y], [p2X, p2Y], [p3X, p3Y], [p4X, p4Y], [p5X, p5Y]];
                        arrPoint = [x, y];
                        // TODO: perhaps do some mathmatical trickery here with the Y-coordinate to compensate for pie tilt?
                        if (isPointInPoly(arrPoly, arrPoint)) {
                            ctx.restore();
                            return {datapoint: [s.percent, s.data], dataIndex: 0, series: s, seriesIndex: i};
                        }
                    }
                    ctx.restore();
                }
            }

            return null;
        }

        function onMouseMove(e) {
            triggerClickHoverEvent('plothover', e);
        }

        function onClick(e) {
            triggerClickHoverEvent('plotclick', e);
        }

        // trigger click or hover event (they send the same parameters so we share their code)
        function triggerClickHoverEvent(eventname, e) {
            var offset = plot.offset(),
                canvasX = parseInt(e.pageX - offset.left),
                canvasY = parseInt(e.pageY - offset.top),
                item = findNearbySlice(canvasX, canvasY);

            if (options.grid.autoHighlight) {
                // clear auto-highlights
                for (var i = 0; i < highlights.length; ++i) {
                    var h = highlights[i];
                    if (h.auto == eventname && !(item && h.series == item.series))
                        unhighlight(h.series);
                }
            }

            // highlight the slice
            if (item)
                highlight(item.series, eventname);

            // trigger any hover bind events
            var pos = {pageX: e.pageX, pageY: e.pageY};
            target.trigger(eventname, [pos, item]);
        }

        function highlight(s, auto) {
            if (typeof s == "number")
                s = series[s];

            var i = indexOfHighlight(s);
            if (i == -1) {
                highlights.push({series: s, auto: auto});
                plot.triggerRedrawOverlay();
            }
            else if (!auto)
                highlights[i].auto = false;
        }

        function unhighlight(s) {
            if (s == null) {
                highlights = [];
                plot.triggerRedrawOverlay();
            }

            if (typeof s == "number")
                s = series[s];

            var i = indexOfHighlight(s);
            if (i != -1) {
                highlights.splice(i, 1);
                plot.triggerRedrawOverlay();
            }
        }

        function indexOfHighlight(s) {
            for (var i = 0; i < highlights.length; ++i) {
                var h = highlights[i];
                if (h.series == s)
                    return i;
            }
            return -1;
        }

        function drawOverlay(plot, octx) {
            //alert(options.series.pie.radius);
            var options = plot.getOptions();
            //alert(options.series.pie.radius);

            var radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius;

            octx.save();
            octx.translate(centerLeft, centerTop);
            octx.scale(1, options.series.pie.tilt);

            for (i = 0; i < highlights.length; ++i)
                drawHighlight(highlights[i].series);

            drawDonutHole(octx);

            octx.restore();

            function drawHighlight(series) {
                if (series.angle < 0) return;

                //octx.fillStyle = parseColor(options.series.pie.highlight.color).scale(null, null, null, options.series.pie.highlight.opacity).toString();
                octx.fillStyle = "rgba(255, 255, 255, " + options.series.pie.highlight.opacity + ")"; // this is temporary until we have access to parseColor

                octx.beginPath();
                if (Math.abs(series.angle - Math.PI * 2) > 0.000000001)
                    octx.moveTo(0, 0); // Center of the pie
                octx.arc(0, 0, radius, series.startAngle, series.startAngle + series.angle, false);
                octx.closePath();
                octx.fill();
            }

        }

    } // end init (plugin body)

    // define pie specific options and their default values
    var options = {
        series: {
            pie: {
                show: false,
                radius: 'auto',	// actual radius of the visible pie (based on full calculated radius if <=1, or hard pixel value)
                innerRadius: 0, /* for donut */
                startAngle: 3 / 2,
                tilt: 1,
                offset: {
                    top: 0,
                    left: 'auto'
                },
                stroke: {
                    color: '#FFF',
                    width: 1
                },
                label: {
                    show: 'auto',
                    formatter: function (label, slice) {
                        return '<div style="font-size:x-small;text-align:center;padding:2px;color:' + slice.color + ';">' + label + '<br/>' + Math.round(slice.percent) + '%</div>';
                    },	// formatter function
                    radius: 1,	// radius at which to place the labels (based on full calculated radius if <=1, or hard pixel value)
                    background: {
                        color: null,
                        opacity: 0
                    },
                    threshold: 0	// percentage at which to hide the label (i.e. the slice is too narrow)
                },
                combine: {
                    threshold: -1,	// percentage at which to combine little slices into one larger slice
                    color: null,	// color to give the new slice (auto-generated if null)
                    label: 'Other'	// label to give the new slice
                },
                highlight: {
                    //color: '#FFF',		// will add this functionality once parseColor is available
                    opacity: 0.5
                }
            }
        }
    };

    $.plot.plugins.push({
        init: init,
        options: options,
        name: "pie",
        version: "1.0"
    });
})(jQuery);

/* Flot plugin for automatically redrawing plots as the placeholder resizes.

 Copyright (c) 2007-2013 IOLA and Ole Laursen.
 Licensed under the MIT license.

 It works by listening for changes on the placeholder div (through the jQuery
 resize event plugin) - if the size changes, it will redraw the plot.

 There are no options. If you need to disable the plugin for some plots, you
 can just fix the size of their placeholders.

 */

/* Inline dependency:
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

(function ($, h, c) {
    var a = $([]), e = $.resize = $.extend($.resize, {}), i, k = "setTimeout", j = "resize", d = j + "-special-event", b = "delay", f = "throttleWindow";
    e[b] = 250;
    e[f] = true;
    $.event.special[j] = {
        setup: function () {
            if (!e[f] && this[k]) {
                return false
            }
            var l = $(this);
            a = a.add(l);
            $.data(this, d, {w: l.width(), h: l.height()});
            if (a.length === 1) {
                g()
            }
        }, teardown: function () {
            if (!e[f] && this[k]) {
                return false
            }
            var l = $(this);
            a = a.not(l);
            l.removeData(d);
            if (!a.length) {
                clearTimeout(i)
            }
        }, add: function (l) {
            if (!e[f] && this[k]) {
                return false
            }
            var n;

            function m(s, o, p) {
                var q = $(this), r = $.data(this, d);
                r.w = o !== c ? o : q.width();
                r.h = p !== c ? p : q.height();
                n.apply(this, arguments)
            }

            if ($.isFunction(l)) {
                n = l;
                return m
            } else {
                n = l.handler;
                l.handler = m
            }
        }
    };
    function g() {
        i = h[k](function () {
            a.each(function () {
                var n = $(this), m = n.width(), l = n.height(), o = $.data(this, d);
                if (m !== o.w || l !== o.h) {
                    n.trigger(j, [o.w = m, o.h = l])
                }
            });
            g()
        }, e[b])
    }
})(jQuery, this);

(function ($) {
    var options = {}; // no options

    function init(plot) {
        function onResize() {
            var placeholder = plot.getPlaceholder();

            // somebody might have hidden us and we can't plot
            // when we don't have the dimensions
            if (placeholder.width() == 0 || placeholder.height() == 0)
                return;

            plot.resize();
            plot.setupGrid();
            plot.draw();
        }

        function bindEvents(plot, eventHolder) {
            plot.getPlaceholder().resize(onResize);
        }

        function shutdown(plot, eventHolder) {
            plot.getPlaceholder().unbind("resize", onResize);
        }

        plot.hooks.bindEvents.push(bindEvents);
        plot.hooks.shutdown.push(shutdown);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'resize',
        version: '1.0'
    });
})(jQuery);
/*
 * jquery.flot.tooltip
 * 
 * description: easy-to-use tooltips for Flot charts
 * version: 0.6.2
 * author: Krzysztof Urbas @krzysu [myviews.pl]
 * website: https://github.com/krzysu/flot.tooltip
 * 
 * build on 2013-09-30
 * released under MIT License, 2012
 */
(function (t) {
    var o = {
        tooltip: !1,
        tooltipOpts: {
            content: "%s | X: %x | Y: %y",
            xDateFormat: null,
            yDateFormat: null,
            shifts: {x: 10, y: 20},
            defaultTheme: !0,
            onHover: function () {
            }
        }
    }, i = function (t) {
        this.tipPosition = {x: 0, y: 0}, this.init(t)
    };
    i.prototype.init = function (o) {
        function i(t) {
            var o = {};
            o.x = t.pageX, o.y = t.pageY, s.updateTooltipPosition(o)
        }

        function e(t, o, i) {
            var e = s.getDomElement();
            if (i) {
                var n;
                n = s.stringFormat(s.tooltipOptions.content, i), e.html(n), s.updateTooltipPosition({
                    x: o.pageX,
                    y: o.pageY
                }), e.css({
                    left: s.tipPosition.x + s.tooltipOptions.shifts.x,
                    top: s.tipPosition.y + s.tooltipOptions.shifts.y
                }).show(), "function" == typeof s.tooltipOptions.onHover && s.tooltipOptions.onHover(i, e)
            } else e.hide().html("")
        }

        var s = this;
        o.hooks.bindEvents.push(function (o, n) {
            s.plotOptions = o.getOptions(), s.plotOptions.tooltip !== !1 && void 0 !== s.plotOptions.tooltip && (s.tooltipOptions = s.plotOptions.tooltipOpts, s.getDomElement(), t(o.getPlaceholder()).bind("plothover", e), t(n).bind("mousemove", i))
        }), o.hooks.shutdown.push(function (o, s) {
            t(o.getPlaceholder()).unbind("plothover", e), t(s).unbind("mousemove", i)
        })
    }, i.prototype.getDomElement = function () {
        var o;
        return t("#flotTip").length > 0 ? o = t("#flotTip") : (o = t("<div />").attr("id", "flotTip"), o.appendTo("body").hide().css({position: "absolute"}), this.tooltipOptions.defaultTheme && o.css({
            background: "#fff",
            "z-index": "100",
            padding: "0.4em 0.6em",
            "border-radius": "0.5em",
            "font-size": "0.8em",
            border: "1px solid #111",
            display: "none",
            "white-space": "nowrap"
        })), o
    }, i.prototype.updateTooltipPosition = function (o) {
        var i = t("#flotTip").outerWidth() + this.tooltipOptions.shifts.x, e = t("#flotTip").outerHeight() + this.tooltipOptions.shifts.y;
        o.x - t(window).scrollLeft() > t(window).innerWidth() - i && (o.x -= i), o.y - t(window).scrollTop() > t(window).innerHeight() - e && (o.y -= e), this.tipPosition.x = o.x, this.tipPosition.y = o.y
    }, i.prototype.stringFormat = function (t, o) {
        var i = /%p\.{0,1}(\d{0,})/, e = /%s/, s = /%x\.{0,1}(?:\d{0,})/, n = /%y\.{0,1}(?:\d{0,})/;
        return "function" == typeof t && (t = t(o.series.label, o.series.data[o.dataIndex][0], o.series.data[o.dataIndex][1], o)), o.series.percent !== void 0 && (t = this.adjustValPrecision(i, t, o.series.percent)), o.series.label !== void 0 && (t = t.replace(e, o.series.label)), this.isTimeMode("xaxis", o) && this.isXDateFormat(o) && (t = t.replace(s, this.timestampToDate(o.series.data[o.dataIndex][0], this.tooltipOptions.xDateFormat))), this.isTimeMode("yaxis", o) && this.isYDateFormat(o) && (t = t.replace(n, this.timestampToDate(o.series.data[o.dataIndex][1], this.tooltipOptions.yDateFormat))), "number" == typeof o.series.data[o.dataIndex][0] && (t = this.adjustValPrecision(s, t, o.series.data[o.dataIndex][0])), "number" == typeof o.series.data[o.dataIndex][1] && (t = this.adjustValPrecision(n, t, o.series.data[o.dataIndex][1])), o.series.xaxis.tickFormatter !== void 0 && (t = t.replace(s, o.series.xaxis.tickFormatter(o.series.data[o.dataIndex][0], o.series.xaxis))), o.series.yaxis.tickFormatter !== void 0 && (t = t.replace(n, o.series.yaxis.tickFormatter(o.series.data[o.dataIndex][1], o.series.yaxis))), t
    }, i.prototype.isTimeMode = function (t, o) {
        return o.series[t].options.mode !== void 0 && "time" === o.series[t].options.mode
    }, i.prototype.isXDateFormat = function () {
        return this.tooltipOptions.xDateFormat !== void 0 && null !== this.tooltipOptions.xDateFormat
    }, i.prototype.isYDateFormat = function () {
        return this.tooltipOptions.yDateFormat !== void 0 && null !== this.tooltipOptions.yDateFormat
    }, i.prototype.timestampToDate = function (o, i) {
        var e = new Date(o);
        return t.plot.formatDate(e, i)
    }, i.prototype.adjustValPrecision = function (t, o, i) {
        var e, s = o.match(t);
        return null !== s && "" !== RegExp.$1 && (e = RegExp.$1, i = i.toFixed(e), o = o.replace(t, i)), o
    };
    var e = function (t) {
        new i(t)
    };
    t.plot.plugins.push({init: e, options: o, name: "tooltip", version: "0.6.1"})
})(jQuery);
// Morris.js Charts sample data for SB Admin template

$(function () {

    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    // Donut Chart
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    // Line Chart
    Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'morris-line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [{
            d: '2012-10-01',
            visits: 802
        }, {
            d: '2012-10-02',
            visits: 783
        }, {
            d: '2012-10-03',
            visits: 820
        }, {
            d: '2012-10-04',
            visits: 839
        }, {
            d: '2012-10-05',
            visits: 792
        }, {
            d: '2012-10-06',
            visits: 859
        }, {
            d: '2012-10-07',
            visits: 790
        }, {
            d: '2012-10-08',
            visits: 1680
        }, {
            d: '2012-10-09',
            visits: 1592
        }, {
            d: '2012-10-10',
            visits: 1420
        }, {
            d: '2012-10-11',
            visits: 882
        }, {
            d: '2012-10-12',
            visits: 889
        }, {
            d: '2012-10-13',
            visits: 819
        }, {
            d: '2012-10-14',
            visits: 849
        }, {
            d: '2012-10-15',
            visits: 870
        }, {
            d: '2012-10-16',
            visits: 1063
        }, {
            d: '2012-10-17',
            visits: 1192
        }, {
            d: '2012-10-18',
            visits: 1224
        }, {
            d: '2012-10-19',
            visits: 1329
        }, {
            d: '2012-10-20',
            visits: 1329
        }, {
            d: '2012-10-21',
            visits: 1239
        }, {
            d: '2012-10-22',
            visits: 1190
        }, {
            d: '2012-10-23',
            visits: 1312
        }, {
            d: '2012-10-24',
            visits: 1293
        }, {
            d: '2012-10-25',
            visits: 1283
        }, {
            d: '2012-10-26',
            visits: 1248
        }, {
            d: '2012-10-27',
            visits: 1323
        }, {
            d: '2012-10-28',
            visits: 1390
        }, {
            d: '2012-10-29',
            visits: 1420
        }, {
            d: '2012-10-30',
            visits: 1529
        }, {
            d: '2012-10-31',
            visits: 1892
        },],
        // The name of the data record attribute that contains x-visitss.
        xkey: 'd',
        // A list of names of data record attributes that contain y-visitss.
        ykeys: ['visits'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Visits'],
        // Disables line smoothing
        smooth: false,
        resize: true
    });

    // Bar Chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            device: 'iPhone',
            geekbench: 136
        }, {
            device: 'iPhone 3G',
            geekbench: 137
        }, {
            device: 'iPhone 3GS',
            geekbench: 275
        }, {
            device: 'iPhone 4',
            geekbench: 380
        }, {
            device: 'iPhone 4S',
            geekbench: 655
        }, {
            device: 'iPhone 5',
            geekbench: 1571
        }],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });


});

/* @license
 morris.js v0.5.0
 Copyright 2014 Olly Smith All rights reserved.
 Licensed under the BSD-2-Clause License.
 */


(function () {
    var $, Morris, minutesSpecHelper, secondsSpecHelper,
        __slice = [].slice,
        __bind = function (fn, me) {
            return function () {
                return fn.apply(me, arguments);
            };
        },
        __hasProp = {}.hasOwnProperty,
        __extends = function (child, parent) {
            for (var key in parent) {
                if (__hasProp.call(parent, key)) child[key] = parent[key];
            }
            function ctor() {
                this.constructor = child;
            }

            ctor.prototype = parent.prototype;
            child.prototype = new ctor();
            child.__super__ = parent.prototype;
            return child;
        },
        __indexOf = [].indexOf || function (item) {
                for (var i = 0, l = this.length; i < l; i++) {
                    if (i in this && this[i] === item) return i;
                }
                return -1;
            };

    Morris = window.Morris = {};

    $ = jQuery;

    Morris.EventEmitter = (function () {
        function EventEmitter() {
        }

        EventEmitter.prototype.on = function (name, handler) {
            if (this.handlers == null) {
                this.handlers = {};
            }
            if (this.handlers[name] == null) {
                this.handlers[name] = [];
            }
            this.handlers[name].push(handler);
            return this;
        };

        EventEmitter.prototype.fire = function () {
            var args, handler, name, _i, _len, _ref, _results;
            name = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            if ((this.handlers != null) && (this.handlers[name] != null)) {
                _ref = this.handlers[name];
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    handler = _ref[_i];
                    _results.push(handler.apply(null, args));
                }
                return _results;
            }
        };

        return EventEmitter;

    })();

    Morris.commas = function (num) {
        var absnum, intnum, ret, strabsnum;
        if (num != null) {
            ret = num < 0 ? "-" : "";
            absnum = Math.abs(num);
            intnum = Math.floor(absnum).toFixed(0);
            ret += intnum.replace(/(?=(?:\d{3})+$)(?!^)/g, ',');
            strabsnum = absnum.toString();
            if (strabsnum.length > intnum.length) {
                ret += strabsnum.slice(intnum.length);
            }
            return ret;
        } else {
            return '-';
        }
    };

    Morris.pad2 = function (number) {
        return (number < 10 ? '0' : '') + number;
    };

    Morris.Grid = (function (_super) {
        __extends(Grid, _super);

        function Grid(options) {
            this.resizeHandler = __bind(this.resizeHandler, this);
            var _this = this;
            if (typeof options.element === 'string') {
                this.el = $(document.getElementById(options.element));
            } else {
                this.el = $(options.element);
            }
            if ((this.el == null) || this.el.length === 0) {
                throw new Error("Graph container element not found");
            }
            if (this.el.css('position') === 'static') {
                this.el.css('position', 'relative');
            }
            this.options = $.extend({}, this.gridDefaults, this.defaults || {}, options);
            if (typeof this.options.units === 'string') {
                this.options.postUnits = options.units;
            }
            this.raphael = new Raphael(this.el[0]);
            this.elementWidth = null;
            this.elementHeight = null;
            this.dirty = false;
            this.selectFrom = null;
            if (this.init) {
                this.init();
            }
            this.setData(this.options.data);
            this.el.bind('mousemove', function (evt) {
                var left, offset, right, width, x;
                offset = _this.el.offset();
                x = evt.pageX - offset.left;
                if (_this.selectFrom) {
                    left = _this.data[_this.hitTest(Math.min(x, _this.selectFrom))]._x;
                    right = _this.data[_this.hitTest(Math.max(x, _this.selectFrom))]._x;
                    width = right - left;
                    return _this.selectionRect.attr({
                        x: left,
                        width: width
                    });
                } else {
                    return _this.fire('hovermove', x, evt.pageY - offset.top);
                }
            });
            this.el.bind('mouseleave', function (evt) {
                if (_this.selectFrom) {
                    _this.selectionRect.hide();
                    _this.selectFrom = null;
                }
                return _this.fire('hoverout');
            });
            this.el.bind('touchstart touchmove touchend', function (evt) {
                var offset, touch;
                touch = evt.originalEvent.touches[0] || evt.originalEvent.changedTouches[0];
                offset = _this.el.offset();
                return _this.fire('hovermove', touch.pageX - offset.left, touch.pageY - offset.top);
            });
            this.el.bind('click', function (evt) {
                var offset;
                offset = _this.el.offset();
                return _this.fire('gridclick', evt.pageX - offset.left, evt.pageY - offset.top);
            });
            if (this.options.rangeSelect) {
                this.selectionRect = this.raphael.rect(0, 0, 0, this.el.innerHeight()).attr({
                    fill: this.options.rangeSelectColor,
                    stroke: false
                }).toBack().hide();
                this.el.bind('mousedown', function (evt) {
                    var offset;
                    offset = _this.el.offset();
                    return _this.startRange(evt.pageX - offset.left);
                });
                this.el.bind('mouseup', function (evt) {
                    var offset;
                    offset = _this.el.offset();
                    _this.endRange(evt.pageX - offset.left);
                    return _this.fire('hovermove', evt.pageX - offset.left, evt.pageY - offset.top);
                });
            }
            if (this.options.resize) {
                $(window).bind('resize', function (evt) {
                    if (_this.timeoutId != null) {
                        window.clearTimeout(_this.timeoutId);
                    }
                    return _this.timeoutId = window.setTimeout(_this.resizeHandler, 100);
                });
            }
            this.el.css('-webkit-tap-highlight-color', 'rgba(0,0,0,0)');
            if (this.postInit) {
                this.postInit();
            }
        }

        Grid.prototype.gridDefaults = {
            dateFormat: null,
            axes: true,
            grid: true,
            gridLineColor: '#aaa',
            gridStrokeWidth: 0.5,
            gridTextColor: '#888',
            gridTextSize: 12,
            gridTextFamily: 'sans-serif',
            gridTextWeight: 'normal',
            hideHover: false,
            yLabelFormat: null,
            xLabelAngle: 0,
            numLines: 5,
            padding: 25,
            parseTime: true,
            postUnits: '',
            preUnits: '',
            ymax: 'auto',
            ymin: 'auto 0',
            goals: [],
            goalStrokeWidth: 1.0,
            goalLineColors: ['#666633', '#999966', '#cc6666', '#663333'],
            events: [],
            eventStrokeWidth: 1.0,
            eventLineColors: ['#005a04', '#ccffbb', '#3a5f0b', '#005502'],
            rangeSelect: null,
            rangeSelectColor: '#eef',
            resize: false
        };

        Grid.prototype.setData = function (data, redraw) {
            var e, idx, index, maxGoal, minGoal, ret, row, step, total, y, ykey, ymax, ymin, yval, _ref;
            if (redraw == null) {
                redraw = true;
            }
            this.options.data = data;
            if ((data == null) || data.length === 0) {
                this.data = [];
                this.raphael.clear();
                if (this.hover != null) {
                    this.hover.hide();
                }
                return;
            }
            ymax = this.cumulative ? 0 : null;
            ymin = this.cumulative ? 0 : null;
            if (this.options.goals.length > 0) {
                minGoal = Math.min.apply(Math, this.options.goals);
                maxGoal = Math.max.apply(Math, this.options.goals);
                ymin = ymin != null ? Math.min(ymin, minGoal) : minGoal;
                ymax = ymax != null ? Math.max(ymax, maxGoal) : maxGoal;
            }
            this.data = (function () {
                var _i, _len, _results;
                _results = [];
                for (index = _i = 0, _len = data.length; _i < _len; index = ++_i) {
                    row = data[index];
                    ret = {
                        src: row
                    };
                    ret.label = row[this.options.xkey];
                    if (this.options.parseTime) {
                        ret.x = Morris.parseDate(ret.label);
                        if (this.options.dateFormat) {
                            ret.label = this.options.dateFormat(ret.x);
                        } else if (typeof ret.label === 'number') {
                            ret.label = new Date(ret.label).toString();
                        }
                    } else {
                        ret.x = index;
                        if (this.options.xLabelFormat) {
                            ret.label = this.options.xLabelFormat(ret);
                        }
                    }
                    total = 0;
                    ret.y = (function () {
                        var _j, _len1, _ref, _results1;
                        _ref = this.options.ykeys;
                        _results1 = [];
                        for (idx = _j = 0, _len1 = _ref.length; _j < _len1; idx = ++_j) {
                            ykey = _ref[idx];
                            yval = row[ykey];
                            if (typeof yval === 'string') {
                                yval = parseFloat(yval);
                            }
                            if ((yval != null) && typeof yval !== 'number') {
                                yval = null;
                            }
                            if (yval != null) {
                                if (this.cumulative) {
                                    total += yval;
                                } else {
                                    if (ymax != null) {
                                        ymax = Math.max(yval, ymax);
                                        ymin = Math.min(yval, ymin);
                                    } else {
                                        ymax = ymin = yval;
                                    }
                                }
                            }
                            if (this.cumulative && (total != null)) {
                                ymax = Math.max(total, ymax);
                                ymin = Math.min(total, ymin);
                            }
                            _results1.push(yval);
                        }
                        return _results1;
                    }).call(this);
                    _results.push(ret);
                }
                return _results;
            }).call(this);
            if (this.options.parseTime) {
                this.data = this.data.sort(function (a, b) {
                    return (a.x > b.x) - (b.x > a.x);
                });
            }
            this.xmin = this.data[0].x;
            this.xmax = this.data[this.data.length - 1].x;
            this.events = [];
            if (this.options.events.length > 0) {
                if (this.options.parseTime) {
                    this.events = (function () {
                        var _i, _len, _ref, _results;
                        _ref = this.options.events;
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            e = _ref[_i];
                            _results.push(Morris.parseDate(e));
                        }
                        return _results;
                    }).call(this);
                } else {
                    this.events = this.options.events;
                }
                this.xmax = Math.max(this.xmax, Math.max.apply(Math, this.events));
                this.xmin = Math.min(this.xmin, Math.min.apply(Math, this.events));
            }
            if (this.xmin === this.xmax) {
                this.xmin -= 1;
                this.xmax += 1;
            }
            this.ymin = this.yboundary('min', ymin);
            this.ymax = this.yboundary('max', ymax);
            if (this.ymin === this.ymax) {
                if (ymin) {
                    this.ymin -= 1;
                }
                this.ymax += 1;
            }
            if (((_ref = this.options.axes) === true || _ref === 'both' || _ref === 'y') || this.options.grid === true) {
                if (this.options.ymax === this.gridDefaults.ymax && this.options.ymin === this.gridDefaults.ymin) {
                    this.grid = this.autoGridLines(this.ymin, this.ymax, this.options.numLines);
                    this.ymin = Math.min(this.ymin, this.grid[0]);
                    this.ymax = Math.max(this.ymax, this.grid[this.grid.length - 1]);
                } else {
                    step = (this.ymax - this.ymin) / (this.options.numLines - 1);
                    this.grid = (function () {
                        var _i, _ref1, _ref2, _results;
                        _results = [];
                        for (y = _i = _ref1 = this.ymin, _ref2 = this.ymax; step > 0 ? _i <= _ref2 : _i >= _ref2; y = _i += step) {
                            _results.push(y);
                        }
                        return _results;
                    }).call(this);
                }
            }
            this.dirty = true;
            if (redraw) {
                return this.redraw();
            }
        };

        Grid.prototype.yboundary = function (boundaryType, currentValue) {
            var boundaryOption, suggestedValue;
            boundaryOption = this.options["y" + boundaryType];
            if (typeof boundaryOption === 'string') {
                if (boundaryOption.slice(0, 4) === 'auto') {
                    if (boundaryOption.length > 5) {
                        suggestedValue = parseInt(boundaryOption.slice(5), 10);
                        if (currentValue == null) {
                            return suggestedValue;
                        }
                        return Math[boundaryType](currentValue, suggestedValue);
                    } else {
                        if (currentValue != null) {
                            return currentValue;
                        } else {
                            return 0;
                        }
                    }
                } else {
                    return parseInt(boundaryOption, 10);
                }
            } else {
                return boundaryOption;
            }
        };

        Grid.prototype.autoGridLines = function (ymin, ymax, nlines) {
            var gmax, gmin, grid, smag, span, step, unit, y, ymag;
            span = ymax - ymin;
            ymag = Math.floor(Math.log(span) / Math.log(10));
            unit = Math.pow(10, ymag);
            gmin = Math.floor(ymin / unit) * unit;
            gmax = Math.ceil(ymax / unit) * unit;
            step = (gmax - gmin) / (nlines - 1);
            if (unit === 1 && step > 1 && Math.ceil(step) !== step) {
                step = Math.ceil(step);
                gmax = gmin + step * (nlines - 1);
            }
            if (gmin < 0 && gmax > 0) {
                gmin = Math.floor(ymin / step) * step;
                gmax = Math.ceil(ymax / step) * step;
            }
            if (step < 1) {
                smag = Math.floor(Math.log(step) / Math.log(10));
                grid = (function () {
                    var _i, _results;
                    _results = [];
                    for (y = _i = gmin; step > 0 ? _i <= gmax : _i >= gmax; y = _i += step) {
                        _results.push(parseFloat(y.toFixed(1 - smag)));
                    }
                    return _results;
                })();
            } else {
                grid = (function () {
                    var _i, _results;
                    _results = [];
                    for (y = _i = gmin; step > 0 ? _i <= gmax : _i >= gmax; y = _i += step) {
                        _results.push(y);
                    }
                    return _results;
                })();
            }
            return grid;
        };

        Grid.prototype._calc = function () {
            var bottomOffsets, gridLine, h, i, w, yLabelWidths, _ref, _ref1;
            w = this.el.width();
            h = this.el.height();
            if (this.elementWidth !== w || this.elementHeight !== h || this.dirty) {
                this.elementWidth = w;
                this.elementHeight = h;
                this.dirty = false;
                this.left = this.options.padding;
                this.right = this.elementWidth - this.options.padding;
                this.top = this.options.padding;
                this.bottom = this.elementHeight - this.options.padding;
                if ((_ref = this.options.axes) === true || _ref === 'both' || _ref === 'y') {
                    yLabelWidths = (function () {
                        var _i, _len, _ref1, _results;
                        _ref1 = this.grid;
                        _results = [];
                        for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
                            gridLine = _ref1[_i];
                            _results.push(this.measureText(this.yAxisFormat(gridLine)).width);
                        }
                        return _results;
                    }).call(this);
                    this.left += Math.max.apply(Math, yLabelWidths);
                }
                if ((_ref1 = this.options.axes) === true || _ref1 === 'both' || _ref1 === 'x') {
                    bottomOffsets = (function () {
                        var _i, _ref2, _results;
                        _results = [];
                        for (i = _i = 0, _ref2 = this.data.length; 0 <= _ref2 ? _i < _ref2 : _i > _ref2; i = 0 <= _ref2 ? ++_i : --_i) {
                            _results.push(this.measureText(this.data[i].text, -this.options.xLabelAngle).height);
                        }
                        return _results;
                    }).call(this);
                    this.bottom -= Math.max.apply(Math, bottomOffsets);
                }
                this.width = Math.max(1, this.right - this.left);
                this.height = Math.max(1, this.bottom - this.top);
                this.dx = this.width / (this.xmax - this.xmin);
                this.dy = this.height / (this.ymax - this.ymin);
                if (this.calc) {
                    return this.calc();
                }
            }
        };

        Grid.prototype.transY = function (y) {
            return this.bottom - (y - this.ymin) * this.dy;
        };

        Grid.prototype.transX = function (x) {
            if (this.data.length === 1) {
                return (this.left + this.right) / 2;
            } else {
                return this.left + (x - this.xmin) * this.dx;
            }
        };

        Grid.prototype.redraw = function () {
            this.raphael.clear();
            this._calc();
            this.drawGrid();
            this.drawGoals();
            this.drawEvents();
            if (this.draw) {
                return this.draw();
            }
        };

        Grid.prototype.measureText = function (text, angle) {
            var ret, tt;
            if (angle == null) {
                angle = 0;
            }
            tt = this.raphael.text(100, 100, text).attr('font-size', this.options.gridTextSize).attr('font-family', this.options.gridTextFamily).attr('font-weight', this.options.gridTextWeight).rotate(angle);
            ret = tt.getBBox();
            tt.remove();
            return ret;
        };

        Grid.prototype.yAxisFormat = function (label) {
            return this.yLabelFormat(label);
        };

        Grid.prototype.yLabelFormat = function (label) {
            if (typeof this.options.yLabelFormat === 'function') {
                return this.options.yLabelFormat(label);
            } else {
                return "" + this.options.preUnits + (Morris.commas(label)) + this.options.postUnits;
            }
        };

        Grid.prototype.drawGrid = function () {
            var lineY, y, _i, _len, _ref, _ref1, _ref2, _results;
            if (this.options.grid === false && ((_ref = this.options.axes) !== true && _ref !== 'both' && _ref !== 'y')) {
                return;
            }
            _ref1 = this.grid;
            _results = [];
            for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
                lineY = _ref1[_i];
                y = this.transY(lineY);
                if ((_ref2 = this.options.axes) === true || _ref2 === 'both' || _ref2 === 'y') {
                    this.drawYAxisLabel(this.left - this.options.padding / 2, y, this.yAxisFormat(lineY));
                }
                if (this.options.grid) {
                    _results.push(this.drawGridLine("M" + this.left + "," + y + "H" + (this.left + this.width)));
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        Grid.prototype.drawGoals = function () {
            var color, goal, i, _i, _len, _ref, _results;
            _ref = this.options.goals;
            _results = [];
            for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
                goal = _ref[i];
                color = this.options.goalLineColors[i % this.options.goalLineColors.length];
                _results.push(this.drawGoal(goal, color));
            }
            return _results;
        };

        Grid.prototype.drawEvents = function () {
            var color, event, i, _i, _len, _ref, _results;
            _ref = this.events;
            _results = [];
            for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
                event = _ref[i];
                color = this.options.eventLineColors[i % this.options.eventLineColors.length];
                _results.push(this.drawEvent(event, color));
            }
            return _results;
        };

        Grid.prototype.drawGoal = function (goal, color) {
            return this.raphael.path("M" + this.left + "," + (this.transY(goal)) + "H" + this.right).attr('stroke', color).attr('stroke-width', this.options.goalStrokeWidth);
        };

        Grid.prototype.drawEvent = function (event, color) {
            return this.raphael.path("M" + (this.transX(event)) + "," + this.bottom + "V" + this.top).attr('stroke', color).attr('stroke-width', this.options.eventStrokeWidth);
        };

        Grid.prototype.drawYAxisLabel = function (xPos, yPos, text) {
            return this.raphael.text(xPos, yPos, text).attr('font-size', this.options.gridTextSize).attr('font-family', this.options.gridTextFamily).attr('font-weight', this.options.gridTextWeight).attr('fill', this.options.gridTextColor).attr('text-anchor', 'end');
        };

        Grid.prototype.drawGridLine = function (path) {
            return this.raphael.path(path).attr('stroke', this.options.gridLineColor).attr('stroke-width', this.options.gridStrokeWidth);
        };

        Grid.prototype.startRange = function (x) {
            this.hover.hide();
            this.selectFrom = x;
            return this.selectionRect.attr({
                x: x,
                width: 0
            }).show();
        };

        Grid.prototype.endRange = function (x) {
            var end, start;
            if (this.selectFrom) {
                start = Math.min(this.selectFrom, x);
                end = Math.max(this.selectFrom, x);
                this.options.rangeSelect.call(this.el, {
                    start: this.data[this.hitTest(start)].x,
                    end: this.data[this.hitTest(end)].x
                });
                return this.selectFrom = null;
            }
        };

        Grid.prototype.resizeHandler = function () {
            this.timeoutId = null;
            this.raphael.setSize(this.el.width(), this.el.height());
            return this.redraw();
        };

        return Grid;

    })(Morris.EventEmitter);

    Morris.parseDate = function (date) {
        var isecs, m, msecs, n, o, offsetmins, p, q, r, ret, secs;
        if (typeof date === 'number') {
            return date;
        }
        m = date.match(/^(\d+) Q(\d)$/);
        n = date.match(/^(\d+)-(\d+)$/);
        o = date.match(/^(\d+)-(\d+)-(\d+)$/);
        p = date.match(/^(\d+) W(\d+)$/);
        q = date.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+)(Z|([+-])(\d\d):?(\d\d))?$/);
        r = date.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+):(\d+(\.\d+)?)(Z|([+-])(\d\d):?(\d\d))?$/);
        if (m) {
            return new Date(parseInt(m[1], 10), parseInt(m[2], 10) * 3 - 1, 1).getTime();
        } else if (n) {
            return new Date(parseInt(n[1], 10), parseInt(n[2], 10) - 1, 1).getTime();
        } else if (o) {
            return new Date(parseInt(o[1], 10), parseInt(o[2], 10) - 1, parseInt(o[3], 10)).getTime();
        } else if (p) {
            ret = new Date(parseInt(p[1], 10), 0, 1);
            if (ret.getDay() !== 4) {
                ret.setMonth(0, 1 + ((4 - ret.getDay()) + 7) % 7);
            }
            return ret.getTime() + parseInt(p[2], 10) * 604800000;
        } else if (q) {
            if (!q[6]) {
                return new Date(parseInt(q[1], 10), parseInt(q[2], 10) - 1, parseInt(q[3], 10), parseInt(q[4], 10), parseInt(q[5], 10)).getTime();
            } else {
                offsetmins = 0;
                if (q[6] !== 'Z') {
                    offsetmins = parseInt(q[8], 10) * 60 + parseInt(q[9], 10);
                    if (q[7] === '+') {
                        offsetmins = 0 - offsetmins;
                    }
                }
                return Date.UTC(parseInt(q[1], 10), parseInt(q[2], 10) - 1, parseInt(q[3], 10), parseInt(q[4], 10), parseInt(q[5], 10) + offsetmins);
            }
        } else if (r) {
            secs = parseFloat(r[6]);
            isecs = Math.floor(secs);
            msecs = Math.round((secs - isecs) * 1000);
            if (!r[8]) {
                return new Date(parseInt(r[1], 10), parseInt(r[2], 10) - 1, parseInt(r[3], 10), parseInt(r[4], 10), parseInt(r[5], 10), isecs, msecs).getTime();
            } else {
                offsetmins = 0;
                if (r[8] !== 'Z') {
                    offsetmins = parseInt(r[10], 10) * 60 + parseInt(r[11], 10);
                    if (r[9] === '+') {
                        offsetmins = 0 - offsetmins;
                    }
                }
                return Date.UTC(parseInt(r[1], 10), parseInt(r[2], 10) - 1, parseInt(r[3], 10), parseInt(r[4], 10), parseInt(r[5], 10) + offsetmins, isecs, msecs);
            }
        } else {
            return new Date(parseInt(date, 10), 0, 1).getTime();
        }
    };

    Morris.Hover = (function () {
        Hover.defaults = {
            "class": 'morris-hover morris-default-style'
        };

        function Hover(options) {
            if (options == null) {
                options = {};
            }
            this.options = $.extend({}, Morris.Hover.defaults, options);
            this.el = $("<div class='" + this.options["class"] + "'></div>");
            this.el.hide();
            this.options.parent.append(this.el);
        }

        Hover.prototype.update = function (html, x, y) {
            if (!html) {
                return this.hide();
            } else {
                this.html(html);
                this.show();
                return this.moveTo(x, y);
            }
        };

        Hover.prototype.html = function (content) {
            return this.el.html(content);
        };

        Hover.prototype.moveTo = function (x, y) {
            var hoverHeight, hoverWidth, left, parentHeight, parentWidth, top;
            parentWidth = this.options.parent.innerWidth();
            parentHeight = this.options.parent.innerHeight();
            hoverWidth = this.el.outerWidth();
            hoverHeight = this.el.outerHeight();
            left = Math.min(Math.max(0, x - hoverWidth / 2), parentWidth - hoverWidth);
            if (y != null) {
                top = y - hoverHeight - 10;
                if (top < 0) {
                    top = y + 10;
                    if (top + hoverHeight > parentHeight) {
                        top = parentHeight / 2 - hoverHeight / 2;
                    }
                }
            } else {
                top = parentHeight / 2 - hoverHeight / 2;
            }
            return this.el.css({
                left: left + "px",
                top: parseInt(top) + "px"
            });
        };

        Hover.prototype.show = function () {
            return this.el.show();
        };

        Hover.prototype.hide = function () {
            return this.el.hide();
        };

        return Hover;

    })();

    Morris.Line = (function (_super) {
        __extends(Line, _super);

        function Line(options) {
            this.hilight = __bind(this.hilight, this);
            this.onHoverOut = __bind(this.onHoverOut, this);
            this.onHoverMove = __bind(this.onHoverMove, this);
            this.onGridClick = __bind(this.onGridClick, this);
            if (!(this instanceof Morris.Line)) {
                return new Morris.Line(options);
            }
            Line.__super__.constructor.call(this, options);
        }

        Line.prototype.init = function () {
            if (this.options.hideHover !== 'always') {
                this.hover = new Morris.Hover({
                    parent: this.el
                });
                this.on('hovermove', this.onHoverMove);
                this.on('hoverout', this.onHoverOut);
                return this.on('gridclick', this.onGridClick);
            }
        };

        Line.prototype.defaults = {
            lineWidth: 3,
            pointSize: 4,
            lineColors: ['#0b62a4', '#7A92A3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
            pointStrokeWidths: [1],
            pointStrokeColors: ['#ffffff'],
            pointFillColors: [],
            smooth: true,
            xLabels: 'auto',
            xLabelFormat: null,
            xLabelMargin: 24,
            hideHover: false
        };

        Line.prototype.calc = function () {
            this.calcPoints();
            return this.generatePaths();
        };

        Line.prototype.calcPoints = function () {
            var row, y, _i, _len, _ref, _results;
            _ref = this.data;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                row = _ref[_i];
                row._x = this.transX(row.x);
                row._y = (function () {
                    var _j, _len1, _ref1, _results1;
                    _ref1 = row.y;
                    _results1 = [];
                    for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                        y = _ref1[_j];
                        if (y != null) {
                            _results1.push(this.transY(y));
                        } else {
                            _results1.push(y);
                        }
                    }
                    return _results1;
                }).call(this);
                _results.push(row._ymax = Math.min.apply(Math, [this.bottom].concat((function () {
                    var _j, _len1, _ref1, _results1;
                    _ref1 = row._y;
                    _results1 = [];
                    for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                        y = _ref1[_j];
                        if (y != null) {
                            _results1.push(y);
                        }
                    }
                    return _results1;
                })())));
            }
            return _results;
        };

        Line.prototype.hitTest = function (x) {
            var index, r, _i, _len, _ref;
            if (this.data.length === 0) {
                return null;
            }
            _ref = this.data.slice(1);
            for (index = _i = 0, _len = _ref.length; _i < _len; index = ++_i) {
                r = _ref[index];
                if (x < (r._x + this.data[index]._x) / 2) {
                    break;
                }
            }
            return index;
        };

        Line.prototype.onGridClick = function (x, y) {
            var index;
            index = this.hitTest(x);
            return this.fire('click', index, this.data[index].src, x, y);
        };

        Line.prototype.onHoverMove = function (x, y) {
            var index;
            index = this.hitTest(x);
            return this.displayHoverForRow(index);
        };

        Line.prototype.onHoverOut = function () {
            if (this.options.hideHover !== false) {
                return this.displayHoverForRow(null);
            }
        };

        Line.prototype.displayHoverForRow = function (index) {
            var _ref;
            if (index != null) {
                (_ref = this.hover).update.apply(_ref, this.hoverContentForRow(index));
                return this.hilight(index);
            } else {
                this.hover.hide();
                return this.hilight();
            }
        };

        Line.prototype.hoverContentForRow = function (index) {
            var content, j, row, y, _i, _len, _ref;
            row = this.data[index];
            content = "<div class='morris-hover-row-label'>" + row.label + "</div>";
            _ref = row.y;
            for (j = _i = 0, _len = _ref.length; _i < _len; j = ++_i) {
                y = _ref[j];
                content += "<div class='morris-hover-point' style='color: " + (this.colorFor(row, j, 'label')) + "'>\n  " + this.options.labels[j] + ":\n  " + (this.yLabelFormat(y)) + "\n</div>";
            }
            if (typeof this.options.hoverCallback === 'function') {
                content = this.options.hoverCallback(index, this.options, content, row.src);
            }
            return [content, row._x, row._ymax];
        };

        Line.prototype.generatePaths = function () {
            var coords, i, r, smooth;
            return this.paths = (function () {
                var _i, _ref, _ref1, _results;
                _results = [];
                for (i = _i = 0, _ref = this.options.ykeys.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
                    smooth = typeof this.options.smooth === "boolean" ? this.options.smooth : (_ref1 = this.options.ykeys[i], __indexOf.call(this.options.smooth, _ref1) >= 0);
                    coords = (function () {
                        var _j, _len, _ref2, _results1;
                        _ref2 = this.data;
                        _results1 = [];
                        for (_j = 0, _len = _ref2.length; _j < _len; _j++) {
                            r = _ref2[_j];
                            if (r._y[i] !== void 0) {
                                _results1.push({
                                    x: r._x,
                                    y: r._y[i]
                                });
                            }
                        }
                        return _results1;
                    }).call(this);
                    if (coords.length > 1) {
                        _results.push(Morris.Line.createPath(coords, smooth, this.bottom));
                    } else {
                        _results.push(null);
                    }
                }
                return _results;
            }).call(this);
        };

        Line.prototype.draw = function () {
            var _ref;
            if ((_ref = this.options.axes) === true || _ref === 'both' || _ref === 'x') {
                this.drawXAxis();
            }
            this.drawSeries();
            if (this.options.hideHover === false) {
                return this.displayHoverForRow(this.data.length - 1);
            }
        };

        Line.prototype.drawXAxis = function () {
            var drawLabel, l, labels, prevAngleMargin, prevLabelMargin, row, ypos, _i, _len, _results,
                _this = this;
            ypos = this.bottom + this.options.padding / 2;
            prevLabelMargin = null;
            prevAngleMargin = null;
            drawLabel = function (labelText, xpos) {
                var label, labelBox, margin, offset, textBox;
                label = _this.drawXAxisLabel(_this.transX(xpos), ypos, labelText);
                textBox = label.getBBox();
                label.transform("r" + (-_this.options.xLabelAngle));
                labelBox = label.getBBox();
                label.transform("t0," + (labelBox.height / 2) + "...");
                if (_this.options.xLabelAngle !== 0) {
                    offset = -0.5 * textBox.width * Math.cos(_this.options.xLabelAngle * Math.PI / 180.0);
                    label.transform("t" + offset + ",0...");
                }
                labelBox = label.getBBox();
                if (((prevLabelMargin == null) || prevLabelMargin >= labelBox.x + labelBox.width || (prevAngleMargin != null) && prevAngleMargin >= labelBox.x) && labelBox.x >= 0 && (labelBox.x + labelBox.width) < _this.el.width()) {
                    if (_this.options.xLabelAngle !== 0) {
                        margin = 1.25 * _this.options.gridTextSize / Math.sin(_this.options.xLabelAngle * Math.PI / 180.0);
                        prevAngleMargin = labelBox.x - margin;
                    }
                    return prevLabelMargin = labelBox.x - _this.options.xLabelMargin;
                } else {
                    return label.remove();
                }
            };
            if (this.options.parseTime) {
                if (this.data.length === 1 && this.options.xLabels === 'auto') {
                    labels = [[this.data[0].label, this.data[0].x]];
                } else {
                    labels = Morris.labelSeries(this.xmin, this.xmax, this.width, this.options.xLabels, this.options.xLabelFormat);
                }
            } else {
                labels = (function () {
                    var _i, _len, _ref, _results;
                    _ref = this.data;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        row = _ref[_i];
                        _results.push([row.label, row.x]);
                    }
                    return _results;
                }).call(this);
            }
            labels.reverse();
            _results = [];
            for (_i = 0, _len = labels.length; _i < _len; _i++) {
                l = labels[_i];
                _results.push(drawLabel(l[0], l[1]));
            }
            return _results;
        };

        Line.prototype.drawSeries = function () {
            var i, _i, _j, _ref, _ref1, _results;
            this.seriesPoints = [];
            for (i = _i = _ref = this.options.ykeys.length - 1; _ref <= 0 ? _i <= 0 : _i >= 0; i = _ref <= 0 ? ++_i : --_i) {
                this._drawLineFor(i);
            }
            _results = [];
            for (i = _j = _ref1 = this.options.ykeys.length - 1; _ref1 <= 0 ? _j <= 0 : _j >= 0; i = _ref1 <= 0 ? ++_j : --_j) {
                _results.push(this._drawPointFor(i));
            }
            return _results;
        };

        Line.prototype._drawPointFor = function (index) {
            var circle, row, _i, _len, _ref, _results;
            this.seriesPoints[index] = [];
            _ref = this.data;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                row = _ref[_i];
                circle = null;
                if (row._y[index] != null) {
                    circle = this.drawLinePoint(row._x, row._y[index], this.colorFor(row, index, 'point'), index);
                }
                _results.push(this.seriesPoints[index].push(circle));
            }
            return _results;
        };

        Line.prototype._drawLineFor = function (index) {
            var path;
            path = this.paths[index];
            if (path !== null) {
                return this.drawLinePath(path, this.colorFor(null, index, 'line'), index);
            }
        };

        Line.createPath = function (coords, smooth, bottom) {
            var coord, g, grads, i, ix, lg, path, prevCoord, x1, x2, y1, y2, _i, _len;
            path = "";
            if (smooth) {
                grads = Morris.Line.gradients(coords);
            }
            prevCoord = {
                y: null
            };
            for (i = _i = 0, _len = coords.length; _i < _len; i = ++_i) {
                coord = coords[i];
                if (coord.y != null) {
                    if (prevCoord.y != null) {
                        if (smooth) {
                            g = grads[i];
                            lg = grads[i - 1];
                            ix = (coord.x - prevCoord.x) / 4;
                            x1 = prevCoord.x + ix;
                            y1 = Math.min(bottom, prevCoord.y + ix * lg);
                            x2 = coord.x - ix;
                            y2 = Math.min(bottom, coord.y - ix * g);
                            path += "C" + x1 + "," + y1 + "," + x2 + "," + y2 + "," + coord.x + "," + coord.y;
                        } else {
                            path += "L" + coord.x + "," + coord.y;
                        }
                    } else {
                        if (!smooth || (grads[i] != null)) {
                            path += "M" + coord.x + "," + coord.y;
                        }
                    }
                }
                prevCoord = coord;
            }
            return path;
        };

        Line.gradients = function (coords) {
            var coord, grad, i, nextCoord, prevCoord, _i, _len, _results;
            grad = function (a, b) {
                return (a.y - b.y) / (a.x - b.x);
            };
            _results = [];
            for (i = _i = 0, _len = coords.length; _i < _len; i = ++_i) {
                coord = coords[i];
                if (coord.y != null) {
                    nextCoord = coords[i + 1] || {
                        y: null
                    };
                    prevCoord = coords[i - 1] || {
                        y: null
                    };
                    if ((prevCoord.y != null) && (nextCoord.y != null)) {
                        _results.push(grad(prevCoord, nextCoord));
                    } else if (prevCoord.y != null) {
                        _results.push(grad(prevCoord, coord));
                    } else if (nextCoord.y != null) {
                        _results.push(grad(coord, nextCoord));
                    } else {
                        _results.push(null);
                    }
                } else {
                    _results.push(null);
                }
            }
            return _results;
        };

        Line.prototype.hilight = function (index) {
            var i, _i, _j, _ref, _ref1;
            if (this.prevHilight !== null && this.prevHilight !== index) {
                for (i = _i = 0, _ref = this.seriesPoints.length - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    if (this.seriesPoints[i][this.prevHilight]) {
                        this.seriesPoints[i][this.prevHilight].animate(this.pointShrinkSeries(i));
                    }
                }
            }
            if (index !== null && this.prevHilight !== index) {
                for (i = _j = 0, _ref1 = this.seriesPoints.length - 1; 0 <= _ref1 ? _j <= _ref1 : _j >= _ref1; i = 0 <= _ref1 ? ++_j : --_j) {
                    if (this.seriesPoints[i][index]) {
                        this.seriesPoints[i][index].animate(this.pointGrowSeries(i));
                    }
                }
            }
            return this.prevHilight = index;
        };

        Line.prototype.colorFor = function (row, sidx, type) {
            if (typeof this.options.lineColors === 'function') {
                return this.options.lineColors.call(this, row, sidx, type);
            } else if (type === 'point') {
                return this.options.pointFillColors[sidx % this.options.pointFillColors.length] || this.options.lineColors[sidx % this.options.lineColors.length];
            } else {
                return this.options.lineColors[sidx % this.options.lineColors.length];
            }
        };

        Line.prototype.drawXAxisLabel = function (xPos, yPos, text) {
            return this.raphael.text(xPos, yPos, text).attr('font-size', this.options.gridTextSize).attr('font-family', this.options.gridTextFamily).attr('font-weight', this.options.gridTextWeight).attr('fill', this.options.gridTextColor);
        };

        Line.prototype.drawLinePath = function (path, lineColor, lineIndex) {
            return this.raphael.path(path).attr('stroke', lineColor).attr('stroke-width', this.lineWidthForSeries(lineIndex));
        };

        Line.prototype.drawLinePoint = function (xPos, yPos, pointColor, lineIndex) {
            return this.raphael.circle(xPos, yPos, this.pointSizeForSeries(lineIndex)).attr('fill', pointColor).attr('stroke-width', this.pointStrokeWidthForSeries(lineIndex)).attr('stroke', this.pointStrokeColorForSeries(lineIndex));
        };

        Line.prototype.pointStrokeWidthForSeries = function (index) {
            return this.options.pointStrokeWidths[index % this.options.pointStrokeWidths.length];
        };

        Line.prototype.pointStrokeColorForSeries = function (index) {
            return this.options.pointStrokeColors[index % this.options.pointStrokeColors.length];
        };

        Line.prototype.lineWidthForSeries = function (index) {
            if (this.options.lineWidth instanceof Array) {
                return this.options.lineWidth[index % this.options.lineWidth.length];
            } else {
                return this.options.lineWidth;
            }
        };

        Line.prototype.pointSizeForSeries = function (index) {
            if (this.options.pointSize instanceof Array) {
                return this.options.pointSize[index % this.options.pointSize.length];
            } else {
                return this.options.pointSize;
            }
        };

        Line.prototype.pointGrowSeries = function (index) {
            return Raphael.animation({
                r: this.pointSizeForSeries(index) + 3
            }, 25, 'linear');
        };

        Line.prototype.pointShrinkSeries = function (index) {
            return Raphael.animation({
                r: this.pointSizeForSeries(index)
            }, 25, 'linear');
        };

        return Line;

    })(Morris.Grid);

    Morris.labelSeries = function (dmin, dmax, pxwidth, specName, xLabelFormat) {
        var d, d0, ddensity, name, ret, s, spec, t, _i, _len, _ref;
        ddensity = 200 * (dmax - dmin) / pxwidth;
        d0 = new Date(dmin);
        spec = Morris.LABEL_SPECS[specName];
        if (spec === void 0) {
            _ref = Morris.AUTO_LABEL_ORDER;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                name = _ref[_i];
                s = Morris.LABEL_SPECS[name];
                if (ddensity >= s.span) {
                    spec = s;
                    break;
                }
            }
        }
        if (spec === void 0) {
            spec = Morris.LABEL_SPECS["second"];
        }
        if (xLabelFormat) {
            spec = $.extend({}, spec, {
                fmt: xLabelFormat
            });
        }
        d = spec.start(d0);
        ret = [];
        while ((t = d.getTime()) <= dmax) {
            if (t >= dmin) {
                ret.push([spec.fmt(d), t]);
            }
            spec.incr(d);
        }
        return ret;
    };

    minutesSpecHelper = function (interval) {
        return {
            span: interval * 60 * 1000,
            start: function (d) {
                return new Date(d.getFullYear(), d.getMonth(), d.getDate(), d.getHours());
            },
            fmt: function (d) {
                return "" + (Morris.pad2(d.getHours())) + ":" + (Morris.pad2(d.getMinutes()));
            },
            incr: function (d) {
                return d.setUTCMinutes(d.getUTCMinutes() + interval);
            }
        };
    };

    secondsSpecHelper = function (interval) {
        return {
            span: interval * 1000,
            start: function (d) {
                return new Date(d.getFullYear(), d.getMonth(), d.getDate(), d.getHours(), d.getMinutes());
            },
            fmt: function (d) {
                return "" + (Morris.pad2(d.getHours())) + ":" + (Morris.pad2(d.getMinutes())) + ":" + (Morris.pad2(d.getSeconds()));
            },
            incr: function (d) {
                return d.setUTCSeconds(d.getUTCSeconds() + interval);
            }
        };
    };

    Morris.LABEL_SPECS = {
        "decade": {
            span: 172800000000,
            start: function (d) {
                return new Date(d.getFullYear() - d.getFullYear() % 10, 0, 1);
            },
            fmt: function (d) {
                return "" + (d.getFullYear());
            },
            incr: function (d) {
                return d.setFullYear(d.getFullYear() + 10);
            }
        },
        "year": {
            span: 17280000000,
            start: function (d) {
                return new Date(d.getFullYear(), 0, 1);
            },
            fmt: function (d) {
                return "" + (d.getFullYear());
            },
            incr: function (d) {
                return d.setFullYear(d.getFullYear() + 1);
            }
        },
        "month": {
            span: 2419200000,
            start: function (d) {
                return new Date(d.getFullYear(), d.getMonth(), 1);
            },
            fmt: function (d) {
                return "" + (d.getFullYear()) + "-" + (Morris.pad2(d.getMonth() + 1));
            },
            incr: function (d) {
                return d.setMonth(d.getMonth() + 1);
            }
        },
        "week": {
            span: 604800000,
            start: function (d) {
                return new Date(d.getFullYear(), d.getMonth(), d.getDate());
            },
            fmt: function (d) {
                return "" + (d.getFullYear()) + "-" + (Morris.pad2(d.getMonth() + 1)) + "-" + (Morris.pad2(d.getDate()));
            },
            incr: function (d) {
                return d.setDate(d.getDate() + 7);
            }
        },
        "day": {
            span: 86400000,
            start: function (d) {
                return new Date(d.getFullYear(), d.getMonth(), d.getDate());
            },
            fmt: function (d) {
                return "" + (d.getFullYear()) + "-" + (Morris.pad2(d.getMonth() + 1)) + "-" + (Morris.pad2(d.getDate()));
            },
            incr: function (d) {
                return d.setDate(d.getDate() + 1);
            }
        },
        "hour": minutesSpecHelper(60),
        "30min": minutesSpecHelper(30),
        "15min": minutesSpecHelper(15),
        "10min": minutesSpecHelper(10),
        "5min": minutesSpecHelper(5),
        "minute": minutesSpecHelper(1),
        "30sec": secondsSpecHelper(30),
        "15sec": secondsSpecHelper(15),
        "10sec": secondsSpecHelper(10),
        "5sec": secondsSpecHelper(5),
        "second": secondsSpecHelper(1)
    };

    Morris.AUTO_LABEL_ORDER = ["decade", "year", "month", "week", "day", "hour", "30min", "15min", "10min", "5min", "minute", "30sec", "15sec", "10sec", "5sec", "second"];

    Morris.Area = (function (_super) {
        var areaDefaults;

        __extends(Area, _super);

        areaDefaults = {
            fillOpacity: 'auto',
            behaveLikeLine: false
        };

        function Area(options) {
            var areaOptions;
            if (!(this instanceof Morris.Area)) {
                return new Morris.Area(options);
            }
            areaOptions = $.extend({}, areaDefaults, options);
            this.cumulative = !areaOptions.behaveLikeLine;
            if (areaOptions.fillOpacity === 'auto') {
                areaOptions.fillOpacity = areaOptions.behaveLikeLine ? .8 : 1;
            }
            Area.__super__.constructor.call(this, areaOptions);
        }

        Area.prototype.calcPoints = function () {
            var row, total, y, _i, _len, _ref, _results;
            _ref = this.data;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                row = _ref[_i];
                row._x = this.transX(row.x);
                total = 0;
                row._y = (function () {
                    var _j, _len1, _ref1, _results1;
                    _ref1 = row.y;
                    _results1 = [];
                    for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                        y = _ref1[_j];
                        if (this.options.behaveLikeLine) {
                            _results1.push(this.transY(y));
                        } else {
                            total += y || 0;
                            _results1.push(this.transY(total));
                        }
                    }
                    return _results1;
                }).call(this);
                _results.push(row._ymax = Math.max.apply(Math, row._y));
            }
            return _results;
        };

        Area.prototype.drawSeries = function () {
            var i, range, _i, _j, _k, _len, _ref, _ref1, _results, _results1, _results2;
            this.seriesPoints = [];
            if (this.options.behaveLikeLine) {
                range = (function () {
                    _results = [];
                    for (var _i = 0, _ref = this.options.ykeys.length - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; 0 <= _ref ? _i++ : _i--) {
                        _results.push(_i);
                    }
                    return _results;
                }).apply(this);
            } else {
                range = (function () {
                    _results1 = [];
                    for (var _j = _ref1 = this.options.ykeys.length - 1; _ref1 <= 0 ? _j <= 0 : _j >= 0; _ref1 <= 0 ? _j++ : _j--) {
                        _results1.push(_j);
                    }
                    return _results1;
                }).apply(this);
            }
            _results2 = [];
            for (_k = 0, _len = range.length; _k < _len; _k++) {
                i = range[_k];
                this._drawFillFor(i);
                this._drawLineFor(i);
                _results2.push(this._drawPointFor(i));
            }
            return _results2;
        };

        Area.prototype._drawFillFor = function (index) {
            var path;
            path = this.paths[index];
            if (path !== null) {
                path = path + ("L" + (this.transX(this.xmax)) + "," + this.bottom + "L" + (this.transX(this.xmin)) + "," + this.bottom + "Z");
                return this.drawFilledPath(path, this.fillForSeries(index));
            }
        };

        Area.prototype.fillForSeries = function (i) {
            var color;
            color = Raphael.rgb2hsl(this.colorFor(this.data[i], i, 'line'));
            return Raphael.hsl(color.h, this.options.behaveLikeLine ? color.s * 0.9 : color.s * 0.75, Math.min(0.98, this.options.behaveLikeLine ? color.l * 1.2 : color.l * 1.25));
        };

        Area.prototype.drawFilledPath = function (path, fill) {
            return this.raphael.path(path).attr('fill', fill).attr('fill-opacity', this.options.fillOpacity).attr('stroke', 'none');
        };

        return Area;

    })(Morris.Line);

    Morris.Bar = (function (_super) {
        __extends(Bar, _super);

        function Bar(options) {
            this.onHoverOut = __bind(this.onHoverOut, this);
            this.onHoverMove = __bind(this.onHoverMove, this);
            this.onGridClick = __bind(this.onGridClick, this);
            if (!(this instanceof Morris.Bar)) {
                return new Morris.Bar(options);
            }
            Bar.__super__.constructor.call(this, $.extend({}, options, {
                parseTime: false
            }));
        }

        Bar.prototype.init = function () {
            this.cumulative = this.options.stacked;
            if (this.options.hideHover !== 'always') {
                this.hover = new Morris.Hover({
                    parent: this.el
                });
                this.on('hovermove', this.onHoverMove);
                this.on('hoverout', this.onHoverOut);
                return this.on('gridclick', this.onGridClick);
            }
        };

        Bar.prototype.defaults = {
            barSizeRatio: 0.75,
            barGap: 3,
            barColors: ['#0b62a4', '#7a92a3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
            barOpacity: 1.0,
            barRadius: [0, 0, 0, 0],
            xLabelMargin: 50
        };

        Bar.prototype.calc = function () {
            var _ref;
            this.calcBars();
            if (this.options.hideHover === false) {
                return (_ref = this.hover).update.apply(_ref, this.hoverContentForRow(this.data.length - 1));
            }
        };

        Bar.prototype.calcBars = function () {
            var idx, row, y, _i, _len, _ref, _results;
            _ref = this.data;
            _results = [];
            for (idx = _i = 0, _len = _ref.length; _i < _len; idx = ++_i) {
                row = _ref[idx];
                row._x = this.left + this.width * (idx + 0.5) / this.data.length;
                _results.push(row._y = (function () {
                    var _j, _len1, _ref1, _results1;
                    _ref1 = row.y;
                    _results1 = [];
                    for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                        y = _ref1[_j];
                        if (y != null) {
                            _results1.push(this.transY(y));
                        } else {
                            _results1.push(null);
                        }
                    }
                    return _results1;
                }).call(this));
            }
            return _results;
        };

        Bar.prototype.draw = function () {
            var _ref;
            if ((_ref = this.options.axes) === true || _ref === 'both' || _ref === 'x') {
                this.drawXAxis();
            }
            return this.drawSeries();
        };

        Bar.prototype.drawXAxis = function () {
            var i, label, labelBox, margin, offset, prevAngleMargin, prevLabelMargin, row, textBox, ypos, _i, _ref, _results;
            ypos = this.bottom + (this.options.xAxisLabelTopPadding || this.options.padding / 2);
            prevLabelMargin = null;
            prevAngleMargin = null;
            _results = [];
            for (i = _i = 0, _ref = this.data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
                row = this.data[this.data.length - 1 - i];
                label = this.drawXAxisLabel(row._x, ypos, row.label);
                textBox = label.getBBox();
                label.transform("r" + (-this.options.xLabelAngle));
                labelBox = label.getBBox();
                label.transform("t0," + (labelBox.height / 2) + "...");
                if (this.options.xLabelAngle !== 0) {
                    offset = -0.5 * textBox.width * Math.cos(this.options.xLabelAngle * Math.PI / 180.0);
                    label.transform("t" + offset + ",0...");
                }
                if (((prevLabelMargin == null) || prevLabelMargin >= labelBox.x + labelBox.width || (prevAngleMargin != null) && prevAngleMargin >= labelBox.x) && labelBox.x >= 0 && (labelBox.x + labelBox.width) < this.el.width()) {
                    if (this.options.xLabelAngle !== 0) {
                        margin = 1.25 * this.options.gridTextSize / Math.sin(this.options.xLabelAngle * Math.PI / 180.0);
                        prevAngleMargin = labelBox.x - margin;
                    }
                    _results.push(prevLabelMargin = labelBox.x - this.options.xLabelMargin);
                } else {
                    _results.push(label.remove());
                }
            }
            return _results;
        };

        Bar.prototype.drawSeries = function () {
            var barWidth, bottom, groupWidth, idx, lastTop, left, leftPadding, numBars, row, sidx, size, spaceLeft, top, ypos, zeroPos;
            groupWidth = this.width / this.options.data.length;
            numBars = this.options.stacked ? 1 : this.options.ykeys.length;
            barWidth = (groupWidth * this.options.barSizeRatio - this.options.barGap * (numBars - 1)) / numBars;
            if (this.options.barSize) {
                barWidth = Math.min(barWidth, this.options.barSize);
            }
            spaceLeft = groupWidth - barWidth * numBars - this.options.barGap * (numBars - 1);
            leftPadding = spaceLeft / 2;
            zeroPos = this.ymin <= 0 && this.ymax >= 0 ? this.transY(0) : null;
            return this.bars = (function () {
                var _i, _len, _ref, _results;
                _ref = this.data;
                _results = [];
                for (idx = _i = 0, _len = _ref.length; _i < _len; idx = ++_i) {
                    row = _ref[idx];
                    lastTop = 0;
                    _results.push((function () {
                        var _j, _len1, _ref1, _results1;
                        _ref1 = row._y;
                        _results1 = [];
                        for (sidx = _j = 0, _len1 = _ref1.length; _j < _len1; sidx = ++_j) {
                            ypos = _ref1[sidx];
                            if (ypos !== null) {
                                if (zeroPos) {
                                    top = Math.min(ypos, zeroPos);
                                    bottom = Math.max(ypos, zeroPos);
                                } else {
                                    top = ypos;
                                    bottom = this.bottom;
                                }
                                left = this.left + idx * groupWidth + leftPadding;
                                if (!this.options.stacked) {
                                    left += sidx * (barWidth + this.options.barGap);
                                }
                                size = bottom - top;
                                if (this.options.verticalGridCondition && this.options.verticalGridCondition(row.x)) {
                                    this.drawBar(this.left + idx * groupWidth, this.top, groupWidth, Math.abs(this.top - this.bottom), this.options.verticalGridColor, this.options.verticalGridOpacity, this.options.barRadius);
                                }
                                if (this.options.stacked) {
                                    top -= lastTop;
                                }
                                this.drawBar(left, top, barWidth, size, this.colorFor(row, sidx, 'bar'), this.options.barOpacity, this.options.barRadius);
                                _results1.push(lastTop += size);
                            } else {
                                _results1.push(null);
                            }
                        }
                        return _results1;
                    }).call(this));
                }
                return _results;
            }).call(this);
        };

        Bar.prototype.colorFor = function (row, sidx, type) {
            var r, s;
            if (typeof this.options.barColors === 'function') {
                r = {
                    x: row.x,
                    y: row.y[sidx],
                    label: row.label
                };
                s = {
                    index: sidx,
                    key: this.options.ykeys[sidx],
                    label: this.options.labels[sidx]
                };
                return this.options.barColors.call(this, r, s, type);
            } else {
                return this.options.barColors[sidx % this.options.barColors.length];
            }
        };

        Bar.prototype.hitTest = function (x) {
            if (this.data.length === 0) {
                return null;
            }
            x = Math.max(Math.min(x, this.right), this.left);
            return Math.min(this.data.length - 1, Math.floor((x - this.left) / (this.width / this.data.length)));
        };

        Bar.prototype.onGridClick = function (x, y) {
            var index;
            index = this.hitTest(x);
            return this.fire('click', index, this.data[index].src, x, y);
        };

        Bar.prototype.onHoverMove = function (x, y) {
            var index, _ref;
            index = this.hitTest(x);
            return (_ref = this.hover).update.apply(_ref, this.hoverContentForRow(index));
        };

        Bar.prototype.onHoverOut = function () {
            if (this.options.hideHover !== false) {
                return this.hover.hide();
            }
        };

        Bar.prototype.hoverContentForRow = function (index) {
            var content, j, row, x, y, _i, _len, _ref;
            row = this.data[index];
            content = "<div class='morris-hover-row-label'>" + row.label + "</div>";
            _ref = row.y;
            for (j = _i = 0, _len = _ref.length; _i < _len; j = ++_i) {
                y = _ref[j];
                content += "<div class='morris-hover-point' style='color: " + (this.colorFor(row, j, 'label')) + "'>\n  " + this.options.labels[j] + ":\n  " + (this.yLabelFormat(y)) + "\n</div>";
            }
            if (typeof this.options.hoverCallback === 'function') {
                content = this.options.hoverCallback(index, this.options, content, row.src);
            }
            x = this.left + (index + 0.5) * this.width / this.data.length;
            return [content, x];
        };

        Bar.prototype.drawXAxisLabel = function (xPos, yPos, text) {
            var label;
            return label = this.raphael.text(xPos, yPos, text).attr('font-size', this.options.gridTextSize).attr('font-family', this.options.gridTextFamily).attr('font-weight', this.options.gridTextWeight).attr('fill', this.options.gridTextColor);
        };

        Bar.prototype.drawBar = function (xPos, yPos, width, height, barColor, opacity, radiusArray) {
            var maxRadius, path;
            maxRadius = Math.max.apply(Math, radiusArray);
            if (maxRadius === 0 || maxRadius > height) {
                path = this.raphael.rect(xPos, yPos, width, height);
            } else {
                path = this.raphael.path(this.roundedRect(xPos, yPos, width, height, radiusArray));
            }
            return path.attr('fill', barColor).attr('fill-opacity', opacity).attr('stroke', 'none');
        };

        Bar.prototype.roundedRect = function (x, y, w, h, r) {
            if (r == null) {
                r = [0, 0, 0, 0];
            }
            return ["M", x, r[0] + y, "Q", x, y, x + r[0], y, "L", x + w - r[1], y, "Q", x + w, y, x + w, y + r[1], "L", x + w, y + h - r[2], "Q", x + w, y + h, x + w - r[2], y + h, "L", x + r[3], y + h, "Q", x, y + h, x, y + h - r[3], "Z"];
        };

        return Bar;

    })(Morris.Grid);

    Morris.Donut = (function (_super) {
        __extends(Donut, _super);

        Donut.prototype.defaults = {
            colors: ['#0B62A4', '#3980B5', '#679DC6', '#95BBD7', '#B0CCE1', '#095791', '#095085', '#083E67', '#052C48', '#042135'],
            backgroundColor: '#FFFFFF',
            labelColor: '#000000',
            formatter: Morris.commas,
            resize: false
        };

        function Donut(options) {
            this.resizeHandler = __bind(this.resizeHandler, this);
            this.select = __bind(this.select, this);
            this.click = __bind(this.click, this);
            var _this = this;
            if (!(this instanceof Morris.Donut)) {
                return new Morris.Donut(options);
            }
            this.options = $.extend({}, this.defaults, options);
            if (typeof options.element === 'string') {
                this.el = $(document.getElementById(options.element));
            } else {
                this.el = $(options.element);
            }
            if (this.el === null || this.el.length === 0) {
                throw new Error("Graph placeholder not found.");
            }
            if (options.data === void 0 || options.data.length === 0) {
                return;
            }
            this.raphael = new Raphael(this.el[0]);
            if (this.options.resize) {
                $(window).bind('resize', function (evt) {
                    if (_this.timeoutId != null) {
                        window.clearTimeout(_this.timeoutId);
                    }
                    return _this.timeoutId = window.setTimeout(_this.resizeHandler, 100);
                });
            }
            this.setData(options.data);
        }

        Donut.prototype.redraw = function () {
            var C, cx, cy, i, idx, last, max_value, min, next, seg, total, value, w, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results;
            this.raphael.clear();
            cx = this.el.width() / 2;
            cy = this.el.height() / 2;
            w = (Math.min(cx, cy) - 10) / 3;
            total = 0;
            _ref = this.values;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                value = _ref[_i];
                total += value;
            }
            min = 5 / (2 * w);
            C = 1.9999 * Math.PI - min * this.data.length;
            last = 0;
            idx = 0;
            this.segments = [];
            _ref1 = this.values;
            for (i = _j = 0, _len1 = _ref1.length; _j < _len1; i = ++_j) {
                value = _ref1[i];
                next = last + min + C * (value / total);
                seg = new Morris.DonutSegment(cx, cy, w * 2, w, last, next, this.data[i].color || this.options.colors[idx % this.options.colors.length], this.options.backgroundColor, idx, this.raphael);
                seg.render();
                this.segments.push(seg);
                seg.on('hover', this.select);
                seg.on('click', this.click);
                last = next;
                idx += 1;
            }
            this.text1 = this.drawEmptyDonutLabel(cx, cy - 10, this.options.labelColor, 15, 800);
            this.text2 = this.drawEmptyDonutLabel(cx, cy + 10, this.options.labelColor, 14);
            max_value = Math.max.apply(Math, this.values);
            idx = 0;
            _ref2 = this.values;
            _results = [];
            for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
                value = _ref2[_k];
                if (value === max_value) {
                    this.select(idx);
                    break;
                }
                _results.push(idx += 1);
            }
            return _results;
        };

        Donut.prototype.setData = function (data) {
            var row;
            this.data = data;
            this.values = (function () {
                var _i, _len, _ref, _results;
                _ref = this.data;
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    row = _ref[_i];
                    _results.push(parseFloat(row.value));
                }
                return _results;
            }).call(this);
            return this.redraw();
        };

        Donut.prototype.click = function (idx) {
            return this.fire('click', idx, this.data[idx]);
        };

        Donut.prototype.select = function (idx) {
            var row, s, segment, _i, _len, _ref;
            _ref = this.segments;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                s = _ref[_i];
                s.deselect();
            }
            segment = this.segments[idx];
            segment.select();
            row = this.data[idx];
            return this.setLabels(row.label, this.options.formatter(row.value, row));
        };

        Donut.prototype.setLabels = function (label1, label2) {
            var inner, maxHeightBottom, maxHeightTop, maxWidth, text1bbox, text1scale, text2bbox, text2scale;
            inner = (Math.min(this.el.width() / 2, this.el.height() / 2) - 10) * 2 / 3;
            maxWidth = 1.8 * inner;
            maxHeightTop = inner / 2;
            maxHeightBottom = inner / 3;
            this.text1.attr({
                text: label1,
                transform: ''
            });
            text1bbox = this.text1.getBBox();
            text1scale = Math.min(maxWidth / text1bbox.width, maxHeightTop / text1bbox.height);
            this.text1.attr({
                transform: "S" + text1scale + "," + text1scale + "," + (text1bbox.x + text1bbox.width / 2) + "," + (text1bbox.y + text1bbox.height)
            });
            this.text2.attr({
                text: label2,
                transform: ''
            });
            text2bbox = this.text2.getBBox();
            text2scale = Math.min(maxWidth / text2bbox.width, maxHeightBottom / text2bbox.height);
            return this.text2.attr({
                transform: "S" + text2scale + "," + text2scale + "," + (text2bbox.x + text2bbox.width / 2) + "," + text2bbox.y
            });
        };

        Donut.prototype.drawEmptyDonutLabel = function (xPos, yPos, color, fontSize, fontWeight) {
            var text;
            text = this.raphael.text(xPos, yPos, '').attr('font-size', fontSize).attr('fill', color);
            if (fontWeight != null) {
                text.attr('font-weight', fontWeight);
            }
            return text;
        };

        Donut.prototype.resizeHandler = function () {
            this.timeoutId = null;
            this.raphael.setSize(this.el.width(), this.el.height());
            return this.redraw();
        };

        return Donut;

    })(Morris.EventEmitter);

    Morris.DonutSegment = (function (_super) {
        __extends(DonutSegment, _super);

        function DonutSegment(cx, cy, inner, outer, p0, p1, color, backgroundColor, index, raphael) {
            this.cx = cx;
            this.cy = cy;
            this.inner = inner;
            this.outer = outer;
            this.color = color;
            this.backgroundColor = backgroundColor;
            this.index = index;
            this.raphael = raphael;
            this.deselect = __bind(this.deselect, this);
            this.select = __bind(this.select, this);
            this.sin_p0 = Math.sin(p0);
            this.cos_p0 = Math.cos(p0);
            this.sin_p1 = Math.sin(p1);
            this.cos_p1 = Math.cos(p1);
            this.is_long = (p1 - p0) > Math.PI ? 1 : 0;
            this.path = this.calcSegment(this.inner + 3, this.inner + this.outer - 5);
            this.selectedPath = this.calcSegment(this.inner + 3, this.inner + this.outer);
            this.hilight = this.calcArc(this.inner);
        }

        DonutSegment.prototype.calcArcPoints = function (r) {
            return [this.cx + r * this.sin_p0, this.cy + r * this.cos_p0, this.cx + r * this.sin_p1, this.cy + r * this.cos_p1];
        };

        DonutSegment.prototype.calcSegment = function (r1, r2) {
            var ix0, ix1, iy0, iy1, ox0, ox1, oy0, oy1, _ref, _ref1;
            _ref = this.calcArcPoints(r1), ix0 = _ref[0], iy0 = _ref[1], ix1 = _ref[2], iy1 = _ref[3];
            _ref1 = this.calcArcPoints(r2), ox0 = _ref1[0], oy0 = _ref1[1], ox1 = _ref1[2], oy1 = _ref1[3];
            return ("M" + ix0 + "," + iy0) + ("A" + r1 + "," + r1 + ",0," + this.is_long + ",0," + ix1 + "," + iy1) + ("L" + ox1 + "," + oy1) + ("A" + r2 + "," + r2 + ",0," + this.is_long + ",1," + ox0 + "," + oy0) + "Z";
        };

        DonutSegment.prototype.calcArc = function (r) {
            var ix0, ix1, iy0, iy1, _ref;
            _ref = this.calcArcPoints(r), ix0 = _ref[0], iy0 = _ref[1], ix1 = _ref[2], iy1 = _ref[3];
            return ("M" + ix0 + "," + iy0) + ("A" + r + "," + r + ",0," + this.is_long + ",0," + ix1 + "," + iy1);
        };

        DonutSegment.prototype.render = function () {
            var _this = this;
            this.arc = this.drawDonutArc(this.hilight, this.color);
            return this.seg = this.drawDonutSegment(this.path, this.color, this.backgroundColor, function () {
                return _this.fire('hover', _this.index);
            }, function () {
                return _this.fire('click', _this.index);
            });
        };

        DonutSegment.prototype.drawDonutArc = function (path, color) {
            return this.raphael.path(path).attr({
                stroke: color,
                'stroke-width': 2,
                opacity: 0
            });
        };

        DonutSegment.prototype.drawDonutSegment = function (path, fillColor, strokeColor, hoverFunction, clickFunction) {
            return this.raphael.path(path).attr({
                fill: fillColor,
                stroke: strokeColor,
                'stroke-width': 3
            }).hover(hoverFunction).click(clickFunction);
        };

        DonutSegment.prototype.select = function () {
            if (!this.selected) {
                this.seg.animate({
                    path: this.selectedPath
                }, 150, '<>');
                this.arc.animate({
                    opacity: 1
                }, 150, '<>');
                return this.selected = true;
            }
        };

        DonutSegment.prototype.deselect = function () {
            if (this.selected) {
                this.seg.animate({
                    path: this.path
                }, 150, '<>');
                this.arc.animate({
                    opacity: 0
                }, 150, '<>');
                return this.selected = false;
            }
        };

        return DonutSegment;

    })(Morris.EventEmitter);

}).call(this);

/* @license
 morris.js v0.5.0
 Copyright 2014 Olly Smith All rights reserved.
 Licensed under the BSD-2-Clause License.
 */
(function () {
    var a, b, c, d, e = [].slice, f = function (a, b) {
        return function () {
            return a.apply(b, arguments)
        }
    }, g = {}.hasOwnProperty, h = function (a, b) {
        function c() {
            this.constructor = a
        }

        for (var d in b)g.call(b, d) && (a[d] = b[d]);
        return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
    }, i = [].indexOf || function (a) {
            for (var b = 0, c = this.length; c > b; b++)if (b in this && this[b] === a)return b;
            return -1
        };
    b = window.Morris = {}, a = jQuery, b.EventEmitter = function () {
        function a() {
        }

        return a.prototype.on = function (a, b) {
            return null == this.handlers && (this.handlers = {}), null == this.handlers[a] && (this.handlers[a] = []), this.handlers[a].push(b), this
        }, a.prototype.fire = function () {
            var a, b, c, d, f, g, h;
            if (c = arguments[0], a = 2 <= arguments.length ? e.call(arguments, 1) : [], null != this.handlers && null != this.handlers[c]) {
                for (g = this.handlers[c], h = [], d = 0, f = g.length; f > d; d++)b = g[d], h.push(b.apply(null, a));
                return h
            }
        }, a
    }(), b.commas = function (a) {
        var b, c, d, e;
        return null != a ? (d = 0 > a ? "-" : "", b = Math.abs(a), c = Math.floor(b).toFixed(0), d += c.replace(/(?=(?:\d{3})+$)(?!^)/g, ","), e = b.toString(), e.length > c.length && (d += e.slice(c.length)), d) : "-"
    }, b.pad2 = function (a) {
        return (10 > a ? "0" : "") + a
    }, b.Grid = function (c) {
        function d(b) {
            this.resizeHandler = f(this.resizeHandler, this);
            var c = this;
            if (this.el = "string" == typeof b.element ? a(document.getElementById(b.element)) : a(b.element), null == this.el || 0 === this.el.length)throw new Error("Graph container element not found");
            "static" === this.el.css("position") && this.el.css("position", "relative"), this.options = a.extend({}, this.gridDefaults, this.defaults || {}, b), "string" == typeof this.options.units && (this.options.postUnits = b.units), this.raphael = new Raphael(this.el[0]), this.elementWidth = null, this.elementHeight = null, this.dirty = !1, this.selectFrom = null, this.init && this.init(), this.setData(this.options.data), this.el.bind("mousemove", function (a) {
                var b, d, e, f, g;
                return d = c.el.offset(), g = a.pageX - d.left, c.selectFrom ? (b = c.data[c.hitTest(Math.min(g, c.selectFrom))]._x, e = c.data[c.hitTest(Math.max(g, c.selectFrom))]._x, f = e - b, c.selectionRect.attr({
                    x: b,
                    width: f
                })) : c.fire("hovermove", g, a.pageY - d.top)
            }), this.el.bind("mouseleave", function () {
                return c.selectFrom && (c.selectionRect.hide(), c.selectFrom = null), c.fire("hoverout")
            }), this.el.bind("touchstart touchmove touchend", function (a) {
                var b, d;
                return d = a.originalEvent.touches[0] || a.originalEvent.changedTouches[0], b = c.el.offset(), c.fire("hovermove", d.pageX - b.left, d.pageY - b.top)
            }), this.el.bind("click", function (a) {
                var b;
                return b = c.el.offset(), c.fire("gridclick", a.pageX - b.left, a.pageY - b.top)
            }), this.options.rangeSelect && (this.selectionRect = this.raphael.rect(0, 0, 0, this.el.innerHeight()).attr({
                fill: this.options.rangeSelectColor,
                stroke: !1
            }).toBack().hide(), this.el.bind("mousedown", function (a) {
                var b;
                return b = c.el.offset(), c.startRange(a.pageX - b.left)
            }), this.el.bind("mouseup", function (a) {
                var b;
                return b = c.el.offset(), c.endRange(a.pageX - b.left), c.fire("hovermove", a.pageX - b.left, a.pageY - b.top)
            })), this.options.resize && a(window).bind("resize", function () {
                return null != c.timeoutId && window.clearTimeout(c.timeoutId), c.timeoutId = window.setTimeout(c.resizeHandler, 100)
            }), this.el.css("-webkit-tap-highlight-color", "rgba(0,0,0,0)"), this.postInit && this.postInit()
        }

        return h(d, c), d.prototype.gridDefaults = {
            dateFormat: null,
            axes: !0,
            grid: !0,
            gridLineColor: "#aaa",
            gridStrokeWidth: .5,
            gridTextColor: "#888",
            gridTextSize: 12,
            gridTextFamily: "sans-serif",
            gridTextWeight: "normal",
            hideHover: !1,
            yLabelFormat: null,
            xLabelAngle: 0,
            numLines: 5,
            padding: 25,
            parseTime: !0,
            postUnits: "",
            preUnits: "",
            ymax: "auto",
            ymin: "auto 0",
            goals: [],
            goalStrokeWidth: 1,
            goalLineColors: ["#666633", "#999966", "#cc6666", "#663333"],
            events: [],
            eventStrokeWidth: 1,
            eventLineColors: ["#005a04", "#ccffbb", "#3a5f0b", "#005502"],
            rangeSelect: null,
            rangeSelectColor: "#eef",
            resize: !1
        }, d.prototype.setData = function (a, c) {
            var d, e, f, g, h, i, j, k, l, m, n, o, p, q, r;
            return null == c && (c = !0), this.options.data = a, null == a || 0 === a.length ? (this.data = [], this.raphael.clear(), null != this.hover && this.hover.hide(), void 0) : (o = this.cumulative ? 0 : null, p = this.cumulative ? 0 : null, this.options.goals.length > 0 && (h = Math.min.apply(Math, this.options.goals), g = Math.max.apply(Math, this.options.goals), p = null != p ? Math.min(p, h) : h, o = null != o ? Math.max(o, g) : g), this.data = function () {
                var c, d, g;
                for (g = [], f = c = 0, d = a.length; d > c; f = ++c)j = a[f], i = {src: j}, i.label = j[this.options.xkey], this.options.parseTime ? (i.x = b.parseDate(i.label), this.options.dateFormat ? i.label = this.options.dateFormat(i.x) : "number" == typeof i.label && (i.label = new Date(i.label).toString())) : (i.x = f, this.options.xLabelFormat && (i.label = this.options.xLabelFormat(i))), l = 0, i.y = function () {
                    var a, b, c, d;
                    for (c = this.options.ykeys, d = [], e = a = 0, b = c.length; b > a; e = ++a)n = c[e], q = j[n], "string" == typeof q && (q = parseFloat(q)), null != q && "number" != typeof q && (q = null), null != q && (this.cumulative ? l += q : null != o ? (o = Math.max(q, o), p = Math.min(q, p)) : o = p = q), this.cumulative && null != l && (o = Math.max(l, o), p = Math.min(l, p)), d.push(q);
                    return d
                }.call(this), g.push(i);
                return g
            }.call(this), this.options.parseTime && (this.data = this.data.sort(function (a, b) {
                return (a.x > b.x) - (b.x > a.x)
            })), this.xmin = this.data[0].x, this.xmax = this.data[this.data.length - 1].x, this.events = [], this.options.events.length > 0 && (this.events = this.options.parseTime ? function () {
                var a, c, e, f;
                for (e = this.options.events, f = [], a = 0, c = e.length; c > a; a++)d = e[a], f.push(b.parseDate(d));
                return f
            }.call(this) : this.options.events, this.xmax = Math.max(this.xmax, Math.max.apply(Math, this.events)), this.xmin = Math.min(this.xmin, Math.min.apply(Math, this.events))), this.xmin === this.xmax && (this.xmin -= 1, this.xmax += 1), this.ymin = this.yboundary("min", p), this.ymax = this.yboundary("max", o), this.ymin === this.ymax && (p && (this.ymin -= 1), this.ymax += 1), ((r = this.options.axes) === !0 || "both" === r || "y" === r || this.options.grid === !0) && (this.options.ymax === this.gridDefaults.ymax && this.options.ymin === this.gridDefaults.ymin ? (this.grid = this.autoGridLines(this.ymin, this.ymax, this.options.numLines), this.ymin = Math.min(this.ymin, this.grid[0]), this.ymax = Math.max(this.ymax, this.grid[this.grid.length - 1])) : (k = (this.ymax - this.ymin) / (this.options.numLines - 1), this.grid = function () {
                var a, b, c, d;
                for (d = [], m = a = b = this.ymin, c = this.ymax; k > 0 ? c >= a : a >= c; m = a += k)d.push(m);
                return d
            }.call(this))), this.dirty = !0, c ? this.redraw() : void 0)
        }, d.prototype.yboundary = function (a, b) {
            var c, d;
            return c = this.options["y" + a], "string" == typeof c ? "auto" === c.slice(0, 4) ? c.length > 5 ? (d = parseInt(c.slice(5), 10), null == b ? d : Math[a](b, d)) : null != b ? b : 0 : parseInt(c, 10) : c
        }, d.prototype.autoGridLines = function (a, b, c) {
            var d, e, f, g, h, i, j, k, l;
            return h = b - a, l = Math.floor(Math.log(h) / Math.log(10)), j = Math.pow(10, l), e = Math.floor(a / j) * j, d = Math.ceil(b / j) * j, i = (d - e) / (c - 1), 1 === j && i > 1 && Math.ceil(i) !== i && (i = Math.ceil(i), d = e + i * (c - 1)), 0 > e && d > 0 && (e = Math.floor(a / i) * i, d = Math.ceil(b / i) * i), 1 > i ? (g = Math.floor(Math.log(i) / Math.log(10)), f = function () {
                var a, b;
                for (b = [], k = a = e; i > 0 ? d >= a : a >= d; k = a += i)b.push(parseFloat(k.toFixed(1 - g)));
                return b
            }()) : f = function () {
                var a, b;
                for (b = [], k = a = e; i > 0 ? d >= a : a >= d; k = a += i)b.push(k);
                return b
            }(), f
        }, d.prototype._calc = function () {
            var a, b, c, d, e, f, g, h;
            return e = this.el.width(), c = this.el.height(), (this.elementWidth !== e || this.elementHeight !== c || this.dirty) && (this.elementWidth = e, this.elementHeight = c, this.dirty = !1, this.left = this.options.padding, this.right = this.elementWidth - this.options.padding, this.top = this.options.padding, this.bottom = this.elementHeight - this.options.padding, ((g = this.options.axes) === !0 || "both" === g || "y" === g) && (f = function () {
                var a, c, d, e;
                for (d = this.grid, e = [], a = 0, c = d.length; c > a; a++)b = d[a], e.push(this.measureText(this.yAxisFormat(b)).width);
                return e
            }.call(this), this.left += Math.max.apply(Math, f)), ((h = this.options.axes) === !0 || "both" === h || "x" === h) && (a = function () {
                var a, b, c;
                for (c = [], d = a = 0, b = this.data.length; b >= 0 ? b > a : a > b; d = b >= 0 ? ++a : --a)c.push(this.measureText(this.data[d].text, -this.options.xLabelAngle).height);
                return c
            }.call(this), this.bottom -= Math.max.apply(Math, a)), this.width = Math.max(1, this.right - this.left), this.height = Math.max(1, this.bottom - this.top), this.dx = this.width / (this.xmax - this.xmin), this.dy = this.height / (this.ymax - this.ymin), this.calc) ? this.calc() : void 0
        }, d.prototype.transY = function (a) {
            return this.bottom - (a - this.ymin) * this.dy
        }, d.prototype.transX = function (a) {
            return 1 === this.data.length ? (this.left + this.right) / 2 : this.left + (a - this.xmin) * this.dx
        }, d.prototype.redraw = function () {
            return this.raphael.clear(), this._calc(), this.drawGrid(), this.drawGoals(), this.drawEvents(), this.draw ? this.draw() : void 0
        }, d.prototype.measureText = function (a, b) {
            var c, d;
            return null == b && (b = 0), d = this.raphael.text(100, 100, a).attr("font-size", this.options.gridTextSize).attr("font-family", this.options.gridTextFamily).attr("font-weight", this.options.gridTextWeight).rotate(b), c = d.getBBox(), d.remove(), c
        }, d.prototype.yAxisFormat = function (a) {
            return this.yLabelFormat(a)
        }, d.prototype.yLabelFormat = function (a) {
            return "function" == typeof this.options.yLabelFormat ? this.options.yLabelFormat(a) : "" + this.options.preUnits + b.commas(a) + this.options.postUnits
        }, d.prototype.drawGrid = function () {
            var a, b, c, d, e, f, g, h;
            if (this.options.grid !== !1 || (e = this.options.axes) === !0 || "both" === e || "y" === e) {
                for (f = this.grid, h = [], c = 0, d = f.length; d > c; c++)a = f[c], b = this.transY(a), ((g = this.options.axes) === !0 || "both" === g || "y" === g) && this.drawYAxisLabel(this.left - this.options.padding / 2, b, this.yAxisFormat(a)), this.options.grid ? h.push(this.drawGridLine("M" + this.left + "," + b + "H" + (this.left + this.width))) : h.push(void 0);
                return h
            }
        }, d.prototype.drawGoals = function () {
            var a, b, c, d, e, f, g;
            for (f = this.options.goals, g = [], c = d = 0, e = f.length; e > d; c = ++d)b = f[c], a = this.options.goalLineColors[c % this.options.goalLineColors.length], g.push(this.drawGoal(b, a));
            return g
        }, d.prototype.drawEvents = function () {
            var a, b, c, d, e, f, g;
            for (f = this.events, g = [], c = d = 0, e = f.length; e > d; c = ++d)b = f[c], a = this.options.eventLineColors[c % this.options.eventLineColors.length], g.push(this.drawEvent(b, a));
            return g
        }, d.prototype.drawGoal = function (a, b) {
            return this.raphael.path("M" + this.left + "," + this.transY(a) + "H" + this.right).attr("stroke", b).attr("stroke-width", this.options.goalStrokeWidth)
        }, d.prototype.drawEvent = function (a, b) {
            return this.raphael.path("M" + this.transX(a) + "," + this.bottom + "V" + this.top).attr("stroke", b).attr("stroke-width", this.options.eventStrokeWidth)
        }, d.prototype.drawYAxisLabel = function (a, b, c) {
            return this.raphael.text(a, b, c).attr("font-size", this.options.gridTextSize).attr("font-family", this.options.gridTextFamily).attr("font-weight", this.options.gridTextWeight).attr("fill", this.options.gridTextColor).attr("text-anchor", "end")
        }, d.prototype.drawGridLine = function (a) {
            return this.raphael.path(a).attr("stroke", this.options.gridLineColor).attr("stroke-width", this.options.gridStrokeWidth)
        }, d.prototype.startRange = function (a) {
            return this.hover.hide(), this.selectFrom = a, this.selectionRect.attr({x: a, width: 0}).show()
        }, d.prototype.endRange = function (a) {
            var b, c;
            return this.selectFrom ? (c = Math.min(this.selectFrom, a), b = Math.max(this.selectFrom, a), this.options.rangeSelect.call(this.el, {
                start: this.data[this.hitTest(c)].x,
                end: this.data[this.hitTest(b)].x
            }), this.selectFrom = null) : void 0
        }, d.prototype.resizeHandler = function () {
            return this.timeoutId = null, this.raphael.setSize(this.el.width(), this.el.height()), this.redraw()
        }, d
    }(b.EventEmitter), b.parseDate = function (a) {
        var b, c, d, e, f, g, h, i, j, k, l;
        return "number" == typeof a ? a : (c = a.match(/^(\d+) Q(\d)$/), e = a.match(/^(\d+)-(\d+)$/), f = a.match(/^(\d+)-(\d+)-(\d+)$/), h = a.match(/^(\d+) W(\d+)$/), i = a.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+)(Z|([+-])(\d\d):?(\d\d))?$/), j = a.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+):(\d+(\.\d+)?)(Z|([+-])(\d\d):?(\d\d))?$/), c ? new Date(parseInt(c[1], 10), 3 * parseInt(c[2], 10) - 1, 1).getTime() : e ? new Date(parseInt(e[1], 10), parseInt(e[2], 10) - 1, 1).getTime() : f ? new Date(parseInt(f[1], 10), parseInt(f[2], 10) - 1, parseInt(f[3], 10)).getTime() : h ? (k = new Date(parseInt(h[1], 10), 0, 1), 4 !== k.getDay() && k.setMonth(0, 1 + (4 - k.getDay() + 7) % 7), k.getTime() + 6048e5 * parseInt(h[2], 10)) : i ? i[6] ? (g = 0, "Z" !== i[6] && (g = 60 * parseInt(i[8], 10) + parseInt(i[9], 10), "+" === i[7] && (g = 0 - g)), Date.UTC(parseInt(i[1], 10), parseInt(i[2], 10) - 1, parseInt(i[3], 10), parseInt(i[4], 10), parseInt(i[5], 10) + g)) : new Date(parseInt(i[1], 10), parseInt(i[2], 10) - 1, parseInt(i[3], 10), parseInt(i[4], 10), parseInt(i[5], 10)).getTime() : j ? (l = parseFloat(j[6]), b = Math.floor(l), d = Math.round(1e3 * (l - b)), j[8] ? (g = 0, "Z" !== j[8] && (g = 60 * parseInt(j[10], 10) + parseInt(j[11], 10), "+" === j[9] && (g = 0 - g)), Date.UTC(parseInt(j[1], 10), parseInt(j[2], 10) - 1, parseInt(j[3], 10), parseInt(j[4], 10), parseInt(j[5], 10) + g, b, d)) : new Date(parseInt(j[1], 10), parseInt(j[2], 10) - 1, parseInt(j[3], 10), parseInt(j[4], 10), parseInt(j[5], 10), b, d).getTime()) : new Date(parseInt(a, 10), 0, 1).getTime())
    }, b.Hover = function () {
        function c(c) {
            null == c && (c = {}), this.options = a.extend({}, b.Hover.defaults, c), this.el = a("<div class='" + this.options["class"] + "'></div>"), this.el.hide(), this.options.parent.append(this.el)
        }

        return c.defaults = {"class": "morris-hover morris-default-style"}, c.prototype.update = function (a, b, c) {
            return a ? (this.html(a), this.show(), this.moveTo(b, c)) : this.hide()
        }, c.prototype.html = function (a) {
            return this.el.html(a)
        }, c.prototype.moveTo = function (a, b) {
            var c, d, e, f, g, h;
            return g = this.options.parent.innerWidth(), f = this.options.parent.innerHeight(), d = this.el.outerWidth(), c = this.el.outerHeight(), e = Math.min(Math.max(0, a - d / 2), g - d), null != b ? (h = b - c - 10, 0 > h && (h = b + 10, h + c > f && (h = f / 2 - c / 2))) : h = f / 2 - c / 2, this.el.css({
                left: e + "px",
                top: parseInt(h) + "px"
            })
        }, c.prototype.show = function () {
            return this.el.show()
        }, c.prototype.hide = function () {
            return this.el.hide()
        }, c
    }(), b.Line = function (a) {
        function c(a) {
            return this.hilight = f(this.hilight, this), this.onHoverOut = f(this.onHoverOut, this), this.onHoverMove = f(this.onHoverMove, this), this.onGridClick = f(this.onGridClick, this), this instanceof b.Line ? (c.__super__.constructor.call(this, a), void 0) : new b.Line(a)
        }

        return h(c, a), c.prototype.init = function () {
            return "always" !== this.options.hideHover ? (this.hover = new b.Hover({parent: this.el}), this.on("hovermove", this.onHoverMove), this.on("hoverout", this.onHoverOut), this.on("gridclick", this.onGridClick)) : void 0
        }, c.prototype.defaults = {
            lineWidth: 3,
            pointSize: 4,
            lineColors: ["#0b62a4", "#7A92A3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
            pointStrokeWidths: [1],
            pointStrokeColors: ["#ffffff"],
            pointFillColors: [],
            smooth: !0,
            xLabels: "auto",
            xLabelFormat: null,
            xLabelMargin: 24,
            hideHover: !1
        }, c.prototype.calc = function () {
            return this.calcPoints(), this.generatePaths()
        }, c.prototype.calcPoints = function () {
            var a, b, c, d, e, f;
            for (e = this.data, f = [], c = 0, d = e.length; d > c; c++)a = e[c], a._x = this.transX(a.x), a._y = function () {
                var c, d, e, f;
                for (e = a.y, f = [], c = 0, d = e.length; d > c; c++)b = e[c], null != b ? f.push(this.transY(b)) : f.push(b);
                return f
            }.call(this), f.push(a._ymax = Math.min.apply(Math, [this.bottom].concat(function () {
                var c, d, e, f;
                for (e = a._y, f = [], c = 0, d = e.length; d > c; c++)b = e[c], null != b && f.push(b);
                return f
            }())));
            return f
        }, c.prototype.hitTest = function (a) {
            var b, c, d, e, f;
            if (0 === this.data.length)return null;
            for (f = this.data.slice(1), b = d = 0, e = f.length; e > d && (c = f[b], !(a < (c._x + this.data[b]._x) / 2)); b = ++d);
            return b
        }, c.prototype.onGridClick = function (a, b) {
            var c;
            return c = this.hitTest(a), this.fire("click", c, this.data[c].src, a, b)
        }, c.prototype.onHoverMove = function (a) {
            var b;
            return b = this.hitTest(a), this.displayHoverForRow(b)
        }, c.prototype.onHoverOut = function () {
            return this.options.hideHover !== !1 ? this.displayHoverForRow(null) : void 0
        }, c.prototype.displayHoverForRow = function (a) {
            var b;
            return null != a ? ((b = this.hover).update.apply(b, this.hoverContentForRow(a)), this.hilight(a)) : (this.hover.hide(), this.hilight())
        }, c.prototype.hoverContentForRow = function (a) {
            var b, c, d, e, f, g, h;
            for (d = this.data[a], b = "<div class='morris-hover-row-label'>" + d.label + "</div>", h = d.y, c = f = 0, g = h.length; g > f; c = ++f)e = h[c], b += "<div class='morris-hover-point' style='color: " + this.colorFor(d, c, "label") + "'>\n  " + this.options.labels[c] + ":\n  " + this.yLabelFormat(e) + "\n</div>";
            return "function" == typeof this.options.hoverCallback && (b = this.options.hoverCallback(a, this.options, b, d.src)), [b, d._x, d._ymax]
        }, c.prototype.generatePaths = function () {
            var a, c, d, e;
            return this.paths = function () {
                var f, g, h, j;
                for (j = [], c = f = 0, g = this.options.ykeys.length; g >= 0 ? g > f : f > g; c = g >= 0 ? ++f : --f)e = "boolean" == typeof this.options.smooth ? this.options.smooth : (h = this.options.ykeys[c], i.call(this.options.smooth, h) >= 0), a = function () {
                    var a, b, e, f;
                    for (e = this.data, f = [], a = 0, b = e.length; b > a; a++)d = e[a], void 0 !== d._y[c] && f.push({
                        x: d._x,
                        y: d._y[c]
                    });
                    return f
                }.call(this), a.length > 1 ? j.push(b.Line.createPath(a, e, this.bottom)) : j.push(null);
                return j
            }.call(this)
        }, c.prototype.draw = function () {
            var a;
            return ((a = this.options.axes) === !0 || "both" === a || "x" === a) && this.drawXAxis(), this.drawSeries(), this.options.hideHover === !1 ? this.displayHoverForRow(this.data.length - 1) : void 0
        }, c.prototype.drawXAxis = function () {
            var a, c, d, e, f, g, h, i, j, k, l = this;
            for (h = this.bottom + this.options.padding / 2, f = null, e = null, a = function (a, b) {
                var c, d, g, i, j;
                return c = l.drawXAxisLabel(l.transX(b), h, a), j = c.getBBox(), c.transform("r" + -l.options.xLabelAngle), d = c.getBBox(), c.transform("t0," + d.height / 2 + "..."), 0 !== l.options.xLabelAngle && (i = -.5 * j.width * Math.cos(l.options.xLabelAngle * Math.PI / 180), c.transform("t" + i + ",0...")), d = c.getBBox(), (null == f || f >= d.x + d.width || null != e && e >= d.x) && d.x >= 0 && d.x + d.width < l.el.width() ? (0 !== l.options.xLabelAngle && (g = 1.25 * l.options.gridTextSize / Math.sin(l.options.xLabelAngle * Math.PI / 180), e = d.x - g), f = d.x - l.options.xLabelMargin) : c.remove()
            }, d = this.options.parseTime ? 1 === this.data.length && "auto" === this.options.xLabels ? [[this.data[0].label, this.data[0].x]] : b.labelSeries(this.xmin, this.xmax, this.width, this.options.xLabels, this.options.xLabelFormat) : function () {
                var a, b, c, d;
                for (c = this.data, d = [], a = 0, b = c.length; b > a; a++)g = c[a], d.push([g.label, g.x]);
                return d
            }.call(this), d.reverse(), k = [], i = 0, j = d.length; j > i; i++)c = d[i], k.push(a(c[0], c[1]));
            return k
        }, c.prototype.drawSeries = function () {
            var a, b, c, d, e, f;
            for (this.seriesPoints = [], a = b = d = this.options.ykeys.length - 1; 0 >= d ? 0 >= b : b >= 0; a = 0 >= d ? ++b : --b)this._drawLineFor(a);
            for (f = [], a = c = e = this.options.ykeys.length - 1; 0 >= e ? 0 >= c : c >= 0; a = 0 >= e ? ++c : --c)f.push(this._drawPointFor(a));
            return f
        }, c.prototype._drawPointFor = function (a) {
            var b, c, d, e, f, g;
            for (this.seriesPoints[a] = [], f = this.data, g = [], d = 0, e = f.length; e > d; d++)c = f[d], b = null, null != c._y[a] && (b = this.drawLinePoint(c._x, c._y[a], this.colorFor(c, a, "point"), a)), g.push(this.seriesPoints[a].push(b));
            return g
        }, c.prototype._drawLineFor = function (a) {
            var b;
            return b = this.paths[a], null !== b ? this.drawLinePath(b, this.colorFor(null, a, "line"), a) : void 0
        }, c.createPath = function (a, c, d) {
            var e, f, g, h, i, j, k, l, m, n, o, p, q, r;
            for (k = "", c && (g = b.Line.gradients(a)), l = {y: null}, h = q = 0, r = a.length; r > q; h = ++q)e = a[h], null != e.y && (null != l.y ? c ? (f = g[h], j = g[h - 1], i = (e.x - l.x) / 4, m = l.x + i, o = Math.min(d, l.y + i * j), n = e.x - i, p = Math.min(d, e.y - i * f), k += "C" + m + "," + o + "," + n + "," + p + "," + e.x + "," + e.y) : k += "L" + e.x + "," + e.y : c && null == g[h] || (k += "M" + e.x + "," + e.y)), l = e;
            return k
        }, c.gradients = function (a) {
            var b, c, d, e, f, g, h, i;
            for (c = function (a, b) {
                return (a.y - b.y) / (a.x - b.x)
            }, i = [], d = g = 0, h = a.length; h > g; d = ++g)b = a[d], null != b.y ? (e = a[d + 1] || {y: null}, f = a[d - 1] || {y: null}, null != f.y && null != e.y ? i.push(c(f, e)) : null != f.y ? i.push(c(f, b)) : null != e.y ? i.push(c(b, e)) : i.push(null)) : i.push(null);
            return i
        }, c.prototype.hilight = function (a) {
            var b, c, d, e, f;
            if (null !== this.prevHilight && this.prevHilight !== a)for (b = c = 0, e = this.seriesPoints.length - 1; e >= 0 ? e >= c : c >= e; b = e >= 0 ? ++c : --c)this.seriesPoints[b][this.prevHilight] && this.seriesPoints[b][this.prevHilight].animate(this.pointShrinkSeries(b));
            if (null !== a && this.prevHilight !== a)for (b = d = 0, f = this.seriesPoints.length - 1; f >= 0 ? f >= d : d >= f; b = f >= 0 ? ++d : --d)this.seriesPoints[b][a] && this.seriesPoints[b][a].animate(this.pointGrowSeries(b));
            return this.prevHilight = a
        }, c.prototype.colorFor = function (a, b, c) {
            return "function" == typeof this.options.lineColors ? this.options.lineColors.call(this, a, b, c) : "point" === c ? this.options.pointFillColors[b % this.options.pointFillColors.length] || this.options.lineColors[b % this.options.lineColors.length] : this.options.lineColors[b % this.options.lineColors.length]
        }, c.prototype.drawXAxisLabel = function (a, b, c) {
            return this.raphael.text(a, b, c).attr("font-size", this.options.gridTextSize).attr("font-family", this.options.gridTextFamily).attr("font-weight", this.options.gridTextWeight).attr("fill", this.options.gridTextColor)
        }, c.prototype.drawLinePath = function (a, b, c) {
            return this.raphael.path(a).attr("stroke", b).attr("stroke-width", this.lineWidthForSeries(c))
        }, c.prototype.drawLinePoint = function (a, b, c, d) {
            return this.raphael.circle(a, b, this.pointSizeForSeries(d)).attr("fill", c).attr("stroke-width", this.pointStrokeWidthForSeries(d)).attr("stroke", this.pointStrokeColorForSeries(d))
        }, c.prototype.pointStrokeWidthForSeries = function (a) {
            return this.options.pointStrokeWidths[a % this.options.pointStrokeWidths.length]
        }, c.prototype.pointStrokeColorForSeries = function (a) {
            return this.options.pointStrokeColors[a % this.options.pointStrokeColors.length]
        }, c.prototype.lineWidthForSeries = function (a) {
            return this.options.lineWidth instanceof Array ? this.options.lineWidth[a % this.options.lineWidth.length] : this.options.lineWidth
        }, c.prototype.pointSizeForSeries = function (a) {
            return this.options.pointSize instanceof Array ? this.options.pointSize[a % this.options.pointSize.length] : this.options.pointSize
        }, c.prototype.pointGrowSeries = function (a) {
            return Raphael.animation({r: this.pointSizeForSeries(a) + 3}, 25, "linear")
        }, c.prototype.pointShrinkSeries = function (a) {
            return Raphael.animation({r: this.pointSizeForSeries(a)}, 25, "linear")
        }, c
    }(b.Grid), b.labelSeries = function (c, d, e, f, g) {
        var h, i, j, k, l, m, n, o, p, q, r;
        if (j = 200 * (d - c) / e, i = new Date(c), n = b.LABEL_SPECS[f], void 0 === n)for (r = b.AUTO_LABEL_ORDER, p = 0, q = r.length; q > p; p++)if (k = r[p], m = b.LABEL_SPECS[k], j >= m.span) {
            n = m;
            break
        }
        for (void 0 === n && (n = b.LABEL_SPECS.second), g && (n = a.extend({}, n, {fmt: g})), h = n.start(i), l = []; (o = h.getTime()) <= d;)o >= c && l.push([n.fmt(h), o]), n.incr(h);
        return l
    }, c = function (a) {
        return {
            span: 60 * a * 1e3, start: function (a) {
                return new Date(a.getFullYear(), a.getMonth(), a.getDate(), a.getHours())
            }, fmt: function (a) {
                return "" + b.pad2(a.getHours()) + ":" + b.pad2(a.getMinutes())
            }, incr: function (b) {
                return b.setUTCMinutes(b.getUTCMinutes() + a)
            }
        }
    }, d = function (a) {
        return {
            span: 1e3 * a, start: function (a) {
                return new Date(a.getFullYear(), a.getMonth(), a.getDate(), a.getHours(), a.getMinutes())
            }, fmt: function (a) {
                return "" + b.pad2(a.getHours()) + ":" + b.pad2(a.getMinutes()) + ":" + b.pad2(a.getSeconds())
            }, incr: function (b) {
                return b.setUTCSeconds(b.getUTCSeconds() + a)
            }
        }
    }, b.LABEL_SPECS = {
        decade: {
            span: 1728e8, start: function (a) {
                return new Date(a.getFullYear() - a.getFullYear() % 10, 0, 1)
            }, fmt: function (a) {
                return "" + a.getFullYear()
            }, incr: function (a) {
                return a.setFullYear(a.getFullYear() + 10)
            }
        },
        year: {
            span: 1728e7, start: function (a) {
                return new Date(a.getFullYear(), 0, 1)
            }, fmt: function (a) {
                return "" + a.getFullYear()
            }, incr: function (a) {
                return a.setFullYear(a.getFullYear() + 1)
            }
        },
        month: {
            span: 24192e5, start: function (a) {
                return new Date(a.getFullYear(), a.getMonth(), 1)
            }, fmt: function (a) {
                return "" + a.getFullYear() + "-" + b.pad2(a.getMonth() + 1)
            }, incr: function (a) {
                return a.setMonth(a.getMonth() + 1)
            }
        },
        week: {
            span: 6048e5, start: function (a) {
                return new Date(a.getFullYear(), a.getMonth(), a.getDate())
            }, fmt: function (a) {
                return "" + a.getFullYear() + "-" + b.pad2(a.getMonth() + 1) + "-" + b.pad2(a.getDate())
            }, incr: function (a) {
                return a.setDate(a.getDate() + 7)
            }
        },
        day: {
            span: 864e5, start: function (a) {
                return new Date(a.getFullYear(), a.getMonth(), a.getDate())
            }, fmt: function (a) {
                return "" + a.getFullYear() + "-" + b.pad2(a.getMonth() + 1) + "-" + b.pad2(a.getDate())
            }, incr: function (a) {
                return a.setDate(a.getDate() + 1)
            }
        },
        hour: c(60),
        "30min": c(30),
        "15min": c(15),
        "10min": c(10),
        "5min": c(5),
        minute: c(1),
        "30sec": d(30),
        "15sec": d(15),
        "10sec": d(10),
        "5sec": d(5),
        second: d(1)
    }, b.AUTO_LABEL_ORDER = ["decade", "year", "month", "week", "day", "hour", "30min", "15min", "10min", "5min", "minute", "30sec", "15sec", "10sec", "5sec", "second"], b.Area = function (c) {
        function d(c) {
            var f;
            return this instanceof b.Area ? (f = a.extend({}, e, c), this.cumulative = !f.behaveLikeLine, "auto" === f.fillOpacity && (f.fillOpacity = f.behaveLikeLine ? .8 : 1), d.__super__.constructor.call(this, f), void 0) : new b.Area(c)
        }

        var e;
        return h(d, c), e = {fillOpacity: "auto", behaveLikeLine: !1}, d.prototype.calcPoints = function () {
            var a, b, c, d, e, f, g;
            for (f = this.data, g = [], d = 0, e = f.length; e > d; d++)a = f[d], a._x = this.transX(a.x), b = 0, a._y = function () {
                var d, e, f, g;
                for (f = a.y, g = [], d = 0, e = f.length; e > d; d++)c = f[d], this.options.behaveLikeLine ? g.push(this.transY(c)) : (b += c || 0, g.push(this.transY(b)));
                return g
            }.call(this), g.push(a._ymax = Math.max.apply(Math, a._y));
            return g
        }, d.prototype.drawSeries = function () {
            var a, b, c, d, e, f, g, h;
            for (this.seriesPoints = [], b = this.options.behaveLikeLine ? function () {
                f = [];
                for (var a = 0, b = this.options.ykeys.length - 1; b >= 0 ? b >= a : a >= b; b >= 0 ? a++ : a--)f.push(a);
                return f
            }.apply(this) : function () {
                g = [];
                for (var a = e = this.options.ykeys.length - 1; 0 >= e ? 0 >= a : a >= 0; 0 >= e ? a++ : a--)g.push(a);
                return g
            }.apply(this), h = [], c = 0, d = b.length; d > c; c++)a = b[c], this._drawFillFor(a), this._drawLineFor(a), h.push(this._drawPointFor(a));
            return h
        }, d.prototype._drawFillFor = function (a) {
            var b;
            return b = this.paths[a], null !== b ? (b += "L" + this.transX(this.xmax) + "," + this.bottom + "L" + this.transX(this.xmin) + "," + this.bottom + "Z", this.drawFilledPath(b, this.fillForSeries(a))) : void 0
        }, d.prototype.fillForSeries = function (a) {
            var b;
            return b = Raphael.rgb2hsl(this.colorFor(this.data[a], a, "line")), Raphael.hsl(b.h, this.options.behaveLikeLine ? .9 * b.s : .75 * b.s, Math.min(.98, this.options.behaveLikeLine ? 1.2 * b.l : 1.25 * b.l))
        }, d.prototype.drawFilledPath = function (a, b) {
            return this.raphael.path(a).attr("fill", b).attr("fill-opacity", this.options.fillOpacity).attr("stroke", "none")
        }, d
    }(b.Line), b.Bar = function (c) {
        function d(c) {
            return this.onHoverOut = f(this.onHoverOut, this), this.onHoverMove = f(this.onHoverMove, this), this.onGridClick = f(this.onGridClick, this), this instanceof b.Bar ? (d.__super__.constructor.call(this, a.extend({}, c, {parseTime: !1})), void 0) : new b.Bar(c)
        }

        return h(d, c), d.prototype.init = function () {
            return this.cumulative = this.options.stacked, "always" !== this.options.hideHover ? (this.hover = new b.Hover({parent: this.el}), this.on("hovermove", this.onHoverMove), this.on("hoverout", this.onHoverOut), this.on("gridclick", this.onGridClick)) : void 0
        }, d.prototype.defaults = {
            barSizeRatio: .75,
            barGap: 3,
            barColors: ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
            barOpacity: 1,
            barRadius: [0, 0, 0, 0],
            xLabelMargin: 50
        }, d.prototype.calc = function () {
            var a;
            return this.calcBars(), this.options.hideHover === !1 ? (a = this.hover).update.apply(a, this.hoverContentForRow(this.data.length - 1)) : void 0
        }, d.prototype.calcBars = function () {
            var a, b, c, d, e, f, g;
            for (f = this.data, g = [], a = d = 0, e = f.length; e > d; a = ++d)b = f[a], b._x = this.left + this.width * (a + .5) / this.data.length, g.push(b._y = function () {
                var a, d, e, f;
                for (e = b.y, f = [], a = 0, d = e.length; d > a; a++)c = e[a], null != c ? f.push(this.transY(c)) : f.push(null);
                return f
            }.call(this));
            return g
        }, d.prototype.draw = function () {
            var a;
            return ((a = this.options.axes) === !0 || "both" === a || "x" === a) && this.drawXAxis(), this.drawSeries()
        }, d.prototype.drawXAxis = function () {
            var a, b, c, d, e, f, g, h, i, j, k, l, m;
            for (j = this.bottom + (this.options.xAxisLabelTopPadding || this.options.padding / 2), g = null, f = null, m = [], a = k = 0, l = this.data.length; l >= 0 ? l > k : k > l; a = l >= 0 ? ++k : --k)h = this.data[this.data.length - 1 - a], b = this.drawXAxisLabel(h._x, j, h.label), i = b.getBBox(), b.transform("r" + -this.options.xLabelAngle), c = b.getBBox(), b.transform("t0," + c.height / 2 + "..."), 0 !== this.options.xLabelAngle && (e = -.5 * i.width * Math.cos(this.options.xLabelAngle * Math.PI / 180), b.transform("t" + e + ",0...")), (null == g || g >= c.x + c.width || null != f && f >= c.x) && c.x >= 0 && c.x + c.width < this.el.width() ? (0 !== this.options.xLabelAngle && (d = 1.25 * this.options.gridTextSize / Math.sin(this.options.xLabelAngle * Math.PI / 180), f = c.x - d), m.push(g = c.x - this.options.xLabelMargin)) : m.push(b.remove());
            return m
        }, d.prototype.drawSeries = function () {
            var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o;
            return c = this.width / this.options.data.length, h = this.options.stacked ? 1 : this.options.ykeys.length, a = (c * this.options.barSizeRatio - this.options.barGap * (h - 1)) / h, this.options.barSize && (a = Math.min(a, this.options.barSize)), l = c - a * h - this.options.barGap * (h - 1), g = l / 2, o = this.ymin <= 0 && this.ymax >= 0 ? this.transY(0) : null, this.bars = function () {
                var h, l, p, q;
                for (p = this.data, q = [], d = h = 0, l = p.length; l > h; d = ++h)i = p[d], e = 0, q.push(function () {
                    var h, l, p, q;
                    for (p = i._y, q = [], j = h = 0, l = p.length; l > h; j = ++h)n = p[j], null !== n ? (o ? (m = Math.min(n, o), b = Math.max(n, o)) : (m = n, b = this.bottom), f = this.left + d * c + g, this.options.stacked || (f += j * (a + this.options.barGap)), k = b - m, this.options.verticalGridCondition && this.options.verticalGridCondition(i.x) && this.drawBar(this.left + d * c, this.top, c, Math.abs(this.top - this.bottom), this.options.verticalGridColor, this.options.verticalGridOpacity, this.options.barRadius), this.options.stacked && (m -= e), this.drawBar(f, m, a, k, this.colorFor(i, j, "bar"), this.options.barOpacity, this.options.barRadius), q.push(e += k)) : q.push(null);
                    return q
                }.call(this));
                return q
            }.call(this)
        }, d.prototype.colorFor = function (a, b, c) {
            var d, e;
            return "function" == typeof this.options.barColors ? (d = {
                x: a.x,
                y: a.y[b],
                label: a.label
            }, e = {
                index: b,
                key: this.options.ykeys[b],
                label: this.options.labels[b]
            }, this.options.barColors.call(this, d, e, c)) : this.options.barColors[b % this.options.barColors.length]
        }, d.prototype.hitTest = function (a) {
            return 0 === this.data.length ? null : (a = Math.max(Math.min(a, this.right), this.left), Math.min(this.data.length - 1, Math.floor((a - this.left) / (this.width / this.data.length))))
        }, d.prototype.onGridClick = function (a, b) {
            var c;
            return c = this.hitTest(a), this.fire("click", c, this.data[c].src, a, b)
        }, d.prototype.onHoverMove = function (a) {
            var b, c;
            return b = this.hitTest(a), (c = this.hover).update.apply(c, this.hoverContentForRow(b))
        }, d.prototype.onHoverOut = function () {
            return this.options.hideHover !== !1 ? this.hover.hide() : void 0
        }, d.prototype.hoverContentForRow = function (a) {
            var b, c, d, e, f, g, h, i;
            for (d = this.data[a], b = "<div class='morris-hover-row-label'>" + d.label + "</div>", i = d.y, c = g = 0, h = i.length; h > g; c = ++g)f = i[c], b += "<div class='morris-hover-point' style='color: " + this.colorFor(d, c, "label") + "'>\n  " + this.options.labels[c] + ":\n  " + this.yLabelFormat(f) + "\n</div>";
            return "function" == typeof this.options.hoverCallback && (b = this.options.hoverCallback(a, this.options, b, d.src)), e = this.left + (a + .5) * this.width / this.data.length, [b, e]
        }, d.prototype.drawXAxisLabel = function (a, b, c) {
            var d;
            return d = this.raphael.text(a, b, c).attr("font-size", this.options.gridTextSize).attr("font-family", this.options.gridTextFamily).attr("font-weight", this.options.gridTextWeight).attr("fill", this.options.gridTextColor)
        }, d.prototype.drawBar = function (a, b, c, d, e, f, g) {
            var h, i;
            return h = Math.max.apply(Math, g), i = 0 === h || h > d ? this.raphael.rect(a, b, c, d) : this.raphael.path(this.roundedRect(a, b, c, d, g)), i.attr("fill", e).attr("fill-opacity", f).attr("stroke", "none")
        }, d.prototype.roundedRect = function (a, b, c, d, e) {
            return null == e && (e = [0, 0, 0, 0]), ["M", a, e[0] + b, "Q", a, b, a + e[0], b, "L", a + c - e[1], b, "Q", a + c, b, a + c, b + e[1], "L", a + c, b + d - e[2], "Q", a + c, b + d, a + c - e[2], b + d, "L", a + e[3], b + d, "Q", a, b + d, a, b + d - e[3], "Z"]
        }, d
    }(b.Grid), b.Donut = function (c) {
        function d(c) {
            this.resizeHandler = f(this.resizeHandler, this), this.select = f(this.select, this), this.click = f(this.click, this);
            var d = this;
            if (!(this instanceof b.Donut))return new b.Donut(c);
            if (this.options = a.extend({}, this.defaults, c), this.el = "string" == typeof c.element ? a(document.getElementById(c.element)) : a(c.element), null === this.el || 0 === this.el.length)throw new Error("Graph placeholder not found.");
            void 0 !== c.data && 0 !== c.data.length && (this.raphael = new Raphael(this.el[0]), this.options.resize && a(window).bind("resize", function () {
                return null != d.timeoutId && window.clearTimeout(d.timeoutId), d.timeoutId = window.setTimeout(d.resizeHandler, 100)
            }), this.setData(c.data))
        }

        return h(d, c), d.prototype.defaults = {
            colors: ["#0B62A4", "#3980B5", "#679DC6", "#95BBD7", "#B0CCE1", "#095791", "#095085", "#083E67", "#052C48", "#042135"],
            backgroundColor: "#FFFFFF",
            labelColor: "#000000",
            formatter: b.commas,
            resize: !1
        }, d.prototype.redraw = function () {
            var a, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x;
            for (this.raphael.clear(), c = this.el.width() / 2, d = this.el.height() / 2, n = (Math.min(c, d) - 10) / 3, l = 0, u = this.values, o = 0, r = u.length; r > o; o++)m = u[o], l += m;
            for (i = 5 / (2 * n), a = 1.9999 * Math.PI - i * this.data.length, g = 0, f = 0, this.segments = [], v = this.values, e = p = 0, s = v.length; s > p; e = ++p)m = v[e], j = g + i + a * (m / l), k = new b.DonutSegment(c, d, 2 * n, n, g, j, this.data[e].color || this.options.colors[f % this.options.colors.length], this.options.backgroundColor, f, this.raphael), k.render(), this.segments.push(k), k.on("hover", this.select), k.on("click", this.click), g = j, f += 1;
            for (this.text1 = this.drawEmptyDonutLabel(c, d - 10, this.options.labelColor, 15, 800), this.text2 = this.drawEmptyDonutLabel(c, d + 10, this.options.labelColor, 14), h = Math.max.apply(Math, this.values), f = 0, w = this.values, x = [], q = 0, t = w.length; t > q; q++) {
                if (m = w[q], m === h) {
                    this.select(f);
                    break
                }
                x.push(f += 1)
            }
            return x
        }, d.prototype.setData = function (a) {
            var b;
            return this.data = a, this.values = function () {
                var a, c, d, e;
                for (d = this.data, e = [], a = 0, c = d.length; c > a; a++)b = d[a], e.push(parseFloat(b.value));
                return e
            }.call(this), this.redraw()
        }, d.prototype.click = function (a) {
            return this.fire("click", a, this.data[a])
        }, d.prototype.select = function (a) {
            var b, c, d, e, f, g;
            for (g = this.segments, e = 0, f = g.length; f > e; e++)c = g[e], c.deselect();
            return d = this.segments[a], d.select(), b = this.data[a], this.setLabels(b.label, this.options.formatter(b.value, b))
        }, d.prototype.setLabels = function (a, b) {
            var c, d, e, f, g, h, i, j;
            return c = 2 * (Math.min(this.el.width() / 2, this.el.height() / 2) - 10) / 3, f = 1.8 * c, e = c / 2, d = c / 3, this.text1.attr({
                text: a,
                transform: ""
            }), g = this.text1.getBBox(), h = Math.min(f / g.width, e / g.height), this.text1.attr({transform: "S" + h + "," + h + "," + (g.x + g.width / 2) + "," + (g.y + g.height)}), this.text2.attr({
                text: b,
                transform: ""
            }), i = this.text2.getBBox(), j = Math.min(f / i.width, d / i.height), this.text2.attr({transform: "S" + j + "," + j + "," + (i.x + i.width / 2) + "," + i.y})
        }, d.prototype.drawEmptyDonutLabel = function (a, b, c, d, e) {
            var f;
            return f = this.raphael.text(a, b, "").attr("font-size", d).attr("fill", c), null != e && f.attr("font-weight", e), f
        }, d.prototype.resizeHandler = function () {
            return this.timeoutId = null, this.raphael.setSize(this.el.width(), this.el.height()), this.redraw()
        }, d
    }(b.EventEmitter), b.DonutSegment = function (a) {
        function b(a, b, c, d, e, g, h, i, j, k) {
            this.cx = a, this.cy = b, this.inner = c, this.outer = d, this.color = h, this.backgroundColor = i, this.index = j, this.raphael = k, this.deselect = f(this.deselect, this), this.select = f(this.select, this), this.sin_p0 = Math.sin(e), this.cos_p0 = Math.cos(e), this.sin_p1 = Math.sin(g), this.cos_p1 = Math.cos(g), this.is_long = g - e > Math.PI ? 1 : 0, this.path = this.calcSegment(this.inner + 3, this.inner + this.outer - 5), this.selectedPath = this.calcSegment(this.inner + 3, this.inner + this.outer), this.hilight = this.calcArc(this.inner)
        }

        return h(b, a), b.prototype.calcArcPoints = function (a) {
            return [this.cx + a * this.sin_p0, this.cy + a * this.cos_p0, this.cx + a * this.sin_p1, this.cy + a * this.cos_p1]
        }, b.prototype.calcSegment = function (a, b) {
            var c, d, e, f, g, h, i, j, k, l;
            return k = this.calcArcPoints(a), c = k[0], e = k[1], d = k[2], f = k[3], l = this.calcArcPoints(b), g = l[0], i = l[1], h = l[2], j = l[3], "M" + c + "," + e + ("A" + a + "," + a + ",0," + this.is_long + ",0," + d + "," + f) + ("L" + h + "," + j) + ("A" + b + "," + b + ",0," + this.is_long + ",1," + g + "," + i) + "Z"
        }, b.prototype.calcArc = function (a) {
            var b, c, d, e, f;
            return f = this.calcArcPoints(a), b = f[0], d = f[1], c = f[2], e = f[3], "M" + b + "," + d + ("A" + a + "," + a + ",0," + this.is_long + ",0," + c + "," + e)
        }, b.prototype.render = function () {
            var a = this;
            return this.arc = this.drawDonutArc(this.hilight, this.color), this.seg = this.drawDonutSegment(this.path, this.color, this.backgroundColor, function () {
                return a.fire("hover", a.index)
            }, function () {
                return a.fire("click", a.index)
            })
        }, b.prototype.drawDonutArc = function (a, b) {
            return this.raphael.path(a).attr({stroke: b, "stroke-width": 2, opacity: 0})
        }, b.prototype.drawDonutSegment = function (a, b, c, d, e) {
            return this.raphael.path(a).attr({fill: b, stroke: c, "stroke-width": 3}).hover(d).click(e)
        }, b.prototype.select = function () {
            return this.selected ? void 0 : (this.seg.animate({path: this.selectedPath}, 150, "<>"), this.arc.animate({opacity: 1}, 150, "<>"), this.selected = !0)
        }, b.prototype.deselect = function () {
            return this.selected ? (this.seg.animate({path: this.path}, 150, "<>"), this.arc.animate({opacity: 0}, 150, "<>"), this.selected = !1) : void 0
        }, b
    }(b.EventEmitter)
}).call(this);
// â”Œâ”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â” \\
// â”‚ RaphaÃ«l 2.1.2 - JavaScript Vector Library                          â”‚ \\
// â”œâ”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”¤ \\
// â”‚ Copyright Â© 2008-2012 Dmitry Baranovskiy (http://raphaeljs.com)    â”‚ \\
// â”‚ Copyright Â© 2008-2012 Sencha Labs (http://sencha.com)              â”‚ \\
// â”œâ”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”¤ \\
// â”‚ Licensed under the MIT (http://raphaeljs.com/license.html) license.â”‚ \\
// â””â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”˜ \\
!function (a) {
    var b, c, d = "0.4.2", e = "hasOwnProperty", f = /[\.\/]/, g = "*", h = function () {
    }, i = function (a, b) {
        return a - b
    }, j = {n: {}}, k = function (a, d) {
        a = String(a);
        var e, f = c, g = Array.prototype.slice.call(arguments, 2), h = k.listeners(a), j = 0, l = [], m = {}, n = [], o = b;
        b = a, c = 0;
        for (var p = 0, q = h.length; q > p; p++)"zIndex"in h[p] && (l.push(h[p].zIndex), h[p].zIndex < 0 && (m[h[p].zIndex] = h[p]));
        for (l.sort(i); l[j] < 0;)if (e = m[l[j++]], n.push(e.apply(d, g)), c)return c = f, n;
        for (p = 0; q > p; p++)if (e = h[p], "zIndex"in e)if (e.zIndex == l[j]) {
            if (n.push(e.apply(d, g)), c)break;
            do if (j++, e = m[l[j]], e && n.push(e.apply(d, g)), c)break; while (e)
        } else m[e.zIndex] = e; else if (n.push(e.apply(d, g)), c)break;
        return c = f, b = o, n.length ? n : null
    };
    k._events = j, k.listeners = function (a) {
        var b, c, d, e, h, i, k, l, m = a.split(f), n = j, o = [n], p = [];
        for (e = 0, h = m.length; h > e; e++) {
            for (l = [], i = 0, k = o.length; k > i; i++)for (n = o[i].n, c = [n[m[e]], n[g]], d = 2; d--;)b = c[d], b && (l.push(b), p = p.concat(b.f || []));
            o = l
        }
        return p
    }, k.on = function (a, b) {
        if (a = String(a), "function" != typeof b)return function () {
        };
        for (var c = a.split(f), d = j, e = 0, g = c.length; g > e; e++)d = d.n, d = d.hasOwnProperty(c[e]) && d[c[e]] || (d[c[e]] = {n: {}});
        for (d.f = d.f || [], e = 0, g = d.f.length; g > e; e++)if (d.f[e] == b)return h;
        return d.f.push(b), function (a) {
            +a == +a && (b.zIndex = +a)
        }
    }, k.f = function (a) {
        var b = [].slice.call(arguments, 1);
        return function () {
            k.apply(null, [a, null].concat(b).concat([].slice.call(arguments, 0)))
        }
    }, k.stop = function () {
        c = 1
    }, k.nt = function (a) {
        return a ? new RegExp("(?:\\.|\\/|^)" + a + "(?:\\.|\\/|$)").test(b) : b
    }, k.nts = function () {
        return b.split(f)
    }, k.off = k.unbind = function (a, b) {
        if (!a)return k._events = j = {n: {}}, void 0;
        var c, d, h, i, l, m, n, o = a.split(f), p = [j];
        for (i = 0, l = o.length; l > i; i++)for (m = 0; m < p.length; m += h.length - 2) {
            if (h = [m, 1], c = p[m].n, o[i] != g)c[o[i]] && h.push(c[o[i]]); else for (d in c)c[e](d) && h.push(c[d]);
            p.splice.apply(p, h)
        }
        for (i = 0, l = p.length; l > i; i++)for (c = p[i]; c.n;) {
            if (b) {
                if (c.f) {
                    for (m = 0, n = c.f.length; n > m; m++)if (c.f[m] == b) {
                        c.f.splice(m, 1);
                        break
                    }
                    !c.f.length && delete c.f
                }
                for (d in c.n)if (c.n[e](d) && c.n[d].f) {
                    var q = c.n[d].f;
                    for (m = 0, n = q.length; n > m; m++)if (q[m] == b) {
                        q.splice(m, 1);
                        break
                    }
                    !q.length && delete c.n[d].f
                }
            } else {
                delete c.f;
                for (d in c.n)c.n[e](d) && c.n[d].f && delete c.n[d].f
            }
            c = c.n
        }
    }, k.once = function (a, b) {
        var c = function () {
            return k.unbind(a, c), b.apply(this, arguments)
        };
        return k.on(a, c)
    }, k.version = d, k.toString = function () {
        return "You are running Eve " + d
    }, "undefined" != typeof module && module.exports ? module.exports = k : "undefined" != typeof define ? define("eve", [], function () {
        return k
    }) : a.eve = k
}(this), function (a, b) {
    "function" == typeof define && define.amd ? define(["eve"], function (c) {
        return b(a, c)
    }) : b(a, a.eve)
}(this, function (a, b) {
    function c(a) {
        if (c.is(a, "function"))return u ? a() : b.on("raphael.DOMload", a);
        if (c.is(a, V))return c._engine.create[D](c, a.splice(0, 3 + c.is(a[0], T))).add(a);
        var d = Array.prototype.slice.call(arguments, 0);
        if (c.is(d[d.length - 1], "function")) {
            var e = d.pop();
            return u ? e.call(c._engine.create[D](c, d)) : b.on("raphael.DOMload", function () {
                e.call(c._engine.create[D](c, d))
            })
        }
        return c._engine.create[D](c, arguments)
    }

    function d(a) {
        if ("function" == typeof a || Object(a) !== a)return a;
        var b = new a.constructor;
        for (var c in a)a[z](c) && (b[c] = d(a[c]));
        return b
    }

    function e(a, b) {
        for (var c = 0, d = a.length; d > c; c++)if (a[c] === b)return a.push(a.splice(c, 1)[0])
    }

    function f(a, b, c) {
        function d() {
            var f = Array.prototype.slice.call(arguments, 0), g = f.join("â€"), h = d.cache = d.cache || {}, i = d.count = d.count || [];
            return h[z](g) ? (e(i, g), c ? c(h[g]) : h[g]) : (i.length >= 1e3 && delete h[i.shift()], i.push(g), h[g] = a[D](b, f), c ? c(h[g]) : h[g])
        }

        return d
    }

    function g() {
        return this.hex
    }

    function h(a, b) {
        for (var c = [], d = 0, e = a.length; e - 2 * !b > d; d += 2) {
            var f = [{x: +a[d - 2], y: +a[d - 1]}, {x: +a[d], y: +a[d + 1]}, {
                x: +a[d + 2],
                y: +a[d + 3]
            }, {x: +a[d + 4], y: +a[d + 5]}];
            b ? d ? e - 4 == d ? f[3] = {x: +a[0], y: +a[1]} : e - 2 == d && (f[2] = {
                x: +a[0],
                y: +a[1]
            }, f[3] = {x: +a[2], y: +a[3]}) : f[0] = {
                x: +a[e - 2],
                y: +a[e - 1]
            } : e - 4 == d ? f[3] = f[2] : d || (f[0] = {
                x: +a[d],
                y: +a[d + 1]
            }), c.push(["C", (-f[0].x + 6 * f[1].x + f[2].x) / 6, (-f[0].y + 6 * f[1].y + f[2].y) / 6, (f[1].x + 6 * f[2].x - f[3].x) / 6, (f[1].y + 6 * f[2].y - f[3].y) / 6, f[2].x, f[2].y])
        }
        return c
    }

    function i(a, b, c, d, e) {
        var f = -3 * b + 9 * c - 9 * d + 3 * e, g = a * f + 6 * b - 12 * c + 6 * d;
        return a * g - 3 * b + 3 * c
    }

    function j(a, b, c, d, e, f, g, h, j) {
        null == j && (j = 1), j = j > 1 ? 1 : 0 > j ? 0 : j;
        for (var k = j / 2, l = 12, m = [-.1252, .1252, -.3678, .3678, -.5873, .5873, -.7699, .7699, -.9041, .9041, -.9816, .9816], n = [.2491, .2491, .2335, .2335, .2032, .2032, .1601, .1601, .1069, .1069, .0472, .0472], o = 0, p = 0; l > p; p++) {
            var q = k * m[p] + k, r = i(q, a, c, e, g), s = i(q, b, d, f, h), t = r * r + s * s;
            o += n[p] * N.sqrt(t)
        }
        return k * o
    }

    function k(a, b, c, d, e, f, g, h, i) {
        if (!(0 > i || j(a, b, c, d, e, f, g, h) < i)) {
            var k, l = 1, m = l / 2, n = l - m, o = .01;
            for (k = j(a, b, c, d, e, f, g, h, n); Q(k - i) > o;)m /= 2, n += (i > k ? 1 : -1) * m, k = j(a, b, c, d, e, f, g, h, n);
            return n
        }
    }

    function l(a, b, c, d, e, f, g, h) {
        if (!(O(a, c) < P(e, g) || P(a, c) > O(e, g) || O(b, d) < P(f, h) || P(b, d) > O(f, h))) {
            var i = (a * d - b * c) * (e - g) - (a - c) * (e * h - f * g), j = (a * d - b * c) * (f - h) - (b - d) * (e * h - f * g), k = (a - c) * (f - h) - (b - d) * (e - g);
            if (k) {
                var l = i / k, m = j / k, n = +l.toFixed(2), o = +m.toFixed(2);
                if (!(n < +P(a, c).toFixed(2) || n > +O(a, c).toFixed(2) || n < +P(e, g).toFixed(2) || n > +O(e, g).toFixed(2) || o < +P(b, d).toFixed(2) || o > +O(b, d).toFixed(2) || o < +P(f, h).toFixed(2) || o > +O(f, h).toFixed(2)))return {
                    x: l,
                    y: m
                }
            }
        }
    }

    function m(a, b, d) {
        var e = c.bezierBBox(a), f = c.bezierBBox(b);
        if (!c.isBBoxIntersect(e, f))return d ? 0 : [];
        for (var g = j.apply(0, a), h = j.apply(0, b), i = O(~~(g / 5), 1), k = O(~~(h / 5), 1), m = [], n = [], o = {}, p = d ? 0 : [], q = 0; i + 1 > q; q++) {
            var r = c.findDotsAtSegment.apply(c, a.concat(q / i));
            m.push({x: r.x, y: r.y, t: q / i})
        }
        for (q = 0; k + 1 > q; q++)r = c.findDotsAtSegment.apply(c, b.concat(q / k)), n.push({
            x: r.x,
            y: r.y,
            t: q / k
        });
        for (q = 0; i > q; q++)for (var s = 0; k > s; s++) {
            var t = m[q], u = m[q + 1], v = n[s], w = n[s + 1], x = Q(u.x - t.x) < .001 ? "y" : "x", y = Q(w.x - v.x) < .001 ? "y" : "x", z = l(t.x, t.y, u.x, u.y, v.x, v.y, w.x, w.y);
            if (z) {
                if (o[z.x.toFixed(4)] == z.y.toFixed(4))continue;
                o[z.x.toFixed(4)] = z.y.toFixed(4);
                var A = t.t + Q((z[x] - t[x]) / (u[x] - t[x])) * (u.t - t.t), B = v.t + Q((z[y] - v[y]) / (w[y] - v[y])) * (w.t - v.t);
                A >= 0 && 1.001 >= A && B >= 0 && 1.001 >= B && (d ? p++ : p.push({
                    x: z.x,
                    y: z.y,
                    t1: P(A, 1),
                    t2: P(B, 1)
                }))
            }
        }
        return p
    }

    function n(a, b, d) {
        a = c._path2curve(a), b = c._path2curve(b);
        for (var e, f, g, h, i, j, k, l, n, o, p = d ? 0 : [], q = 0, r = a.length; r > q; q++) {
            var s = a[q];
            if ("M" == s[0])e = i = s[1], f = j = s[2]; else {
                "C" == s[0] ? (n = [e, f].concat(s.slice(1)), e = n[6], f = n[7]) : (n = [e, f, e, f, i, j, i, j], e = i, f = j);
                for (var t = 0, u = b.length; u > t; t++) {
                    var v = b[t];
                    if ("M" == v[0])g = k = v[1], h = l = v[2]; else {
                        "C" == v[0] ? (o = [g, h].concat(v.slice(1)), g = o[6], h = o[7]) : (o = [g, h, g, h, k, l, k, l], g = k, h = l);
                        var w = m(n, o, d);
                        if (d)p += w; else {
                            for (var x = 0, y = w.length; y > x; x++)w[x].segment1 = q, w[x].segment2 = t, w[x].bez1 = n, w[x].bez2 = o;
                            p = p.concat(w)
                        }
                    }
                }
            }
        }
        return p
    }

    function o(a, b, c, d, e, f) {
        null != a ? (this.a = +a, this.b = +b, this.c = +c, this.d = +d, this.e = +e, this.f = +f) : (this.a = 1, this.b = 0, this.c = 0, this.d = 1, this.e = 0, this.f = 0)
    }

    function p() {
        return this.x + H + this.y + H + this.width + " Ã— " + this.height
    }

    function q(a, b, c, d, e, f) {
        function g(a) {
            return ((l * a + k) * a + j) * a
        }

        function h(a, b) {
            var c = i(a, b);
            return ((o * c + n) * c + m) * c
        }

        function i(a, b) {
            var c, d, e, f, h, i;
            for (e = a, i = 0; 8 > i; i++) {
                if (f = g(e) - a, Q(f) < b)return e;
                if (h = (3 * l * e + 2 * k) * e + j, Q(h) < 1e-6)break;
                e -= f / h
            }
            if (c = 0, d = 1, e = a, c > e)return c;
            if (e > d)return d;
            for (; d > c;) {
                if (f = g(e), Q(f - a) < b)return e;
                a > f ? c = e : d = e, e = (d - c) / 2 + c
            }
            return e
        }

        var j = 3 * b, k = 3 * (d - b) - j, l = 1 - j - k, m = 3 * c, n = 3 * (e - c) - m, o = 1 - m - n;
        return h(a, 1 / (200 * f))
    }

    function r(a, b) {
        var c = [], d = {};
        if (this.ms = b, this.times = 1, a) {
            for (var e in a)a[z](e) && (d[_(e)] = a[e], c.push(_(e)));
            c.sort(lb)
        }
        this.anim = d, this.top = c[c.length - 1], this.percents = c
    }

    function s(a, d, e, f, g, h) {
        e = _(e);
        var i, j, k, l, m, n, p = a.ms, r = {}, s = {}, t = {};
        if (f)for (v = 0, x = ic.length; x > v; v++) {
            var u = ic[v];
            if (u.el.id == d.id && u.anim == a) {
                u.percent != e ? (ic.splice(v, 1), k = 1) : j = u, d.attr(u.totalOrigin);
                break
            }
        } else f = +s;
        for (var v = 0, x = a.percents.length; x > v; v++) {
            if (a.percents[v] == e || a.percents[v] > f * a.top) {
                e = a.percents[v], m = a.percents[v - 1] || 0, p = p / a.top * (e - m), l = a.percents[v + 1], i = a.anim[e];
                break
            }
            f && d.attr(a.anim[a.percents[v]])
        }
        if (i) {
            if (j)j.initstatus = f, j.start = new Date - j.ms * f; else {
                for (var y in i)if (i[z](y) && (db[z](y) || d.paper.customAttributes[z](y)))switch (r[y] = d.attr(y), null == r[y] && (r[y] = cb[y]), s[y] = i[y], db[y]) {
                    case T:
                        t[y] = (s[y] - r[y]) / p;
                        break;
                    case"colour":
                        r[y] = c.getRGB(r[y]);
                        var A = c.getRGB(s[y]);
                        t[y] = {r: (A.r - r[y].r) / p, g: (A.g - r[y].g) / p, b: (A.b - r[y].b) / p};
                        break;
                    case"path":
                        var B = Kb(r[y], s[y]), C = B[1];
                        for (r[y] = B[0], t[y] = [], v = 0, x = r[y].length; x > v; v++) {
                            t[y][v] = [0];
                            for (var D = 1, F = r[y][v].length; F > D; D++)t[y][v][D] = (C[v][D] - r[y][v][D]) / p
                        }
                        break;
                    case"transform":
                        var G = d._, H = Pb(G[y], s[y]);
                        if (H)for (r[y] = H.from, s[y] = H.to, t[y] = [], t[y].real = !0, v = 0, x = r[y].length; x > v; v++)for (t[y][v] = [r[y][v][0]], D = 1, F = r[y][v].length; F > D; D++)t[y][v][D] = (s[y][v][D] - r[y][v][D]) / p; else {
                            var K = d.matrix || new o, L = {
                                _: {transform: G.transform}, getBBox: function () {
                                    return d.getBBox(1)
                                }
                            };
                            r[y] = [K.a, K.b, K.c, K.d, K.e, K.f], Nb(L, s[y]), s[y] = L._.transform, t[y] = [(L.matrix.a - K.a) / p, (L.matrix.b - K.b) / p, (L.matrix.c - K.c) / p, (L.matrix.d - K.d) / p, (L.matrix.e - K.e) / p, (L.matrix.f - K.f) / p]
                        }
                        break;
                    case"csv":
                        var M = I(i[y])[J](w), N = I(r[y])[J](w);
                        if ("clip-rect" == y)for (r[y] = N, t[y] = [], v = N.length; v--;)t[y][v] = (M[v] - r[y][v]) / p;
                        s[y] = M;
                        break;
                    default:
                        for (M = [][E](i[y]), N = [][E](r[y]), t[y] = [], v = d.paper.customAttributes[y].length; v--;)t[y][v] = ((M[v] || 0) - (N[v] || 0)) / p
                }
                var O = i.easing, P = c.easing_formulas[O];
                if (!P)if (P = I(O).match(Z), P && 5 == P.length) {
                    var Q = P;
                    P = function (a) {
                        return q(a, +Q[1], +Q[2], +Q[3], +Q[4], p)
                    }
                } else P = nb;
                if (n = i.start || a.start || +new Date, u = {
                        anim: a,
                        percent: e,
                        timestamp: n,
                        start: n + (a.del || 0),
                        status: 0,
                        initstatus: f || 0,
                        stop: !1,
                        ms: p,
                        easing: P,
                        from: r,
                        diff: t,
                        to: s,
                        el: d,
                        callback: i.callback,
                        prev: m,
                        next: l,
                        repeat: h || a.times,
                        origin: d.attr(),
                        totalOrigin: g
                    }, ic.push(u), f && !j && !k && (u.stop = !0, u.start = new Date - p * f, 1 == ic.length))return kc();
                k && (u.start = new Date - u.ms * f), 1 == ic.length && jc(kc)
            }
            b("raphael.anim.start." + d.id, d, a)
        }
    }

    function t(a) {
        for (var b = 0; b < ic.length; b++)ic[b].el.paper == a && ic.splice(b--, 1)
    }

    c.version = "2.1.2", c.eve = b;
    var u, v, w = /[, ]+/, x = {
        circle: 1,
        rect: 1,
        path: 1,
        ellipse: 1,
        text: 1,
        image: 1
    }, y = /\{(\d+)\}/g, z = "hasOwnProperty", A = {
        doc: document,
        win: a
    }, B = {was: Object.prototype[z].call(A.win, "Raphael"), is: A.win.Raphael}, C = function () {
        this.ca = this.customAttributes = {}
    }, D = "apply", E = "concat", F = "ontouchstart"in A.win || A.win.DocumentTouch && A.doc instanceof DocumentTouch, G = "", H = " ", I = String, J = "split", K = "click dblclick mousedown mousemove mouseout mouseover mouseup touchstart touchmove touchend touchcancel"[J](H), L = {
        mousedown: "touchstart",
        mousemove: "touchmove",
        mouseup: "touchend"
    }, M = I.prototype.toLowerCase, N = Math, O = N.max, P = N.min, Q = N.abs, R = N.pow, S = N.PI, T = "number", U = "string", V = "array", W = Object.prototype.toString, X = (c._ISURL = /^url\(['"]?([^\)]+?)['"]?\)$/i, /^\s*((#[a-f\d]{6})|(#[a-f\d]{3})|rgba?\(\s*([\d\.]+%?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+%?(?:\s*,\s*[\d\.]+%?)?)\s*\)|hsba?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\)|hsla?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\))\s*$/i), Y = {
        NaN: 1,
        Infinity: 1,
        "-Infinity": 1
    }, Z = /^(?:cubic-)?bezier\(([^,]+),([^,]+),([^,]+),([^\)]+)\)/, $ = N.round, _ = parseFloat, ab = parseInt, bb = I.prototype.toUpperCase, cb = c._availableAttrs = {
        "arrow-end": "none",
        "arrow-start": "none",
        blur: 0,
        "clip-rect": "0 0 1e9 1e9",
        cursor: "default",
        cx: 0,
        cy: 0,
        fill: "#fff",
        "fill-opacity": 1,
        font: '10px "Arial"',
        "font-family": '"Arial"',
        "font-size": "10",
        "font-style": "normal",
        "font-weight": 400,
        gradient: 0,
        height: 0,
        href: "http://raphaeljs.com/",
        "letter-spacing": 0,
        opacity: 1,
        path: "M0,0",
        r: 0,
        rx: 0,
        ry: 0,
        src: "",
        stroke: "#000",
        "stroke-dasharray": "",
        "stroke-linecap": "butt",
        "stroke-linejoin": "butt",
        "stroke-miterlimit": 0,
        "stroke-opacity": 1,
        "stroke-width": 1,
        target: "_blank",
        "text-anchor": "middle",
        title: "Raphael",
        transform: "",
        width: 0,
        x: 0,
        y: 0
    }, db = c._availableAnimAttrs = {
        blur: T,
        "clip-rect": "csv",
        cx: T,
        cy: T,
        fill: "colour",
        "fill-opacity": T,
        "font-size": T,
        height: T,
        opacity: T,
        path: "path",
        r: T,
        rx: T,
        ry: T,
        stroke: "colour",
        "stroke-opacity": T,
        "stroke-width": T,
        transform: "transform",
        width: T,
        x: T,
        y: T
    }, eb = /[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/, fb = {
        hs: 1,
        rg: 1
    }, gb = /,?([achlmqrstvxz]),?/gi, hb = /([achlmrqstvz])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/gi, ib = /([rstm])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/gi, jb = /(-?\d*\.?\d*(?:e[\-+]?\d+)?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/gi, kb = (c._radial_gradient = /^r(?:\(([^,]+?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*([^\)]+?)\))?/, {}), lb = function (a, b) {
        return _(a) - _(b)
    }, mb = function () {
    }, nb = function (a) {
        return a
    }, ob = c._rectPath = function (a, b, c, d, e) {
        return e ? [["M", a + e, b], ["l", c - 2 * e, 0], ["a", e, e, 0, 0, 1, e, e], ["l", 0, d - 2 * e], ["a", e, e, 0, 0, 1, -e, e], ["l", 2 * e - c, 0], ["a", e, e, 0, 0, 1, -e, -e], ["l", 0, 2 * e - d], ["a", e, e, 0, 0, 1, e, -e], ["z"]] : [["M", a, b], ["l", c, 0], ["l", 0, d], ["l", -c, 0], ["z"]]
    }, pb = function (a, b, c, d) {
        return null == d && (d = c), [["M", a, b], ["m", 0, -d], ["a", c, d, 0, 1, 1, 0, 2 * d], ["a", c, d, 0, 1, 1, 0, -2 * d], ["z"]]
    }, qb = c._getPath = {
        path: function (a) {
            return a.attr("path")
        }, circle: function (a) {
            var b = a.attrs;
            return pb(b.cx, b.cy, b.r)
        }, ellipse: function (a) {
            var b = a.attrs;
            return pb(b.cx, b.cy, b.rx, b.ry)
        }, rect: function (a) {
            var b = a.attrs;
            return ob(b.x, b.y, b.width, b.height, b.r)
        }, image: function (a) {
            var b = a.attrs;
            return ob(b.x, b.y, b.width, b.height)
        }, text: function (a) {
            var b = a._getBBox();
            return ob(b.x, b.y, b.width, b.height)
        }, set: function (a) {
            var b = a._getBBox();
            return ob(b.x, b.y, b.width, b.height)
        }
    }, rb = c.mapPath = function (a, b) {
        if (!b)return a;
        var c, d, e, f, g, h, i;
        for (a = Kb(a), e = 0, g = a.length; g > e; e++)for (i = a[e], f = 1, h = i.length; h > f; f += 2)c = b.x(i[f], i[f + 1]), d = b.y(i[f], i[f + 1]), i[f] = c, i[f + 1] = d;
        return a
    };
    if (c._g = A, c.type = A.win.SVGAngle || A.doc.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? "SVG" : "VML", "VML" == c.type) {
        var sb, tb = A.doc.createElement("div");
        if (tb.innerHTML = '<v:shape adj="1"/>', sb = tb.firstChild, sb.style.behavior = "url(#default#VML)", !sb || "object" != typeof sb.adj)return c.type = G;
        tb = null
    }
    c.svg = !(c.vml = "VML" == c.type), c._Paper = C, c.fn = v = C.prototype = c.prototype, c._id = 0, c._oid = 0, c.is = function (a, b) {
        return b = M.call(b), "finite" == b ? !Y[z](+a) : "array" == b ? a instanceof Array : "null" == b && null === a || b == typeof a && null !== a || "object" == b && a === Object(a) || "array" == b && Array.isArray && Array.isArray(a) || W.call(a).slice(8, -1).toLowerCase() == b
    }, c.angle = function (a, b, d, e, f, g) {
        if (null == f) {
            var h = a - d, i = b - e;
            return h || i ? (180 + 180 * N.atan2(-i, -h) / S + 360) % 360 : 0
        }
        return c.angle(a, b, f, g) - c.angle(d, e, f, g)
    }, c.rad = function (a) {
        return a % 360 * S / 180
    }, c.deg = function (a) {
        return 180 * a / S % 360
    }, c.snapTo = function (a, b, d) {
        if (d = c.is(d, "finite") ? d : 10, c.is(a, V)) {
            for (var e = a.length; e--;)if (Q(a[e] - b) <= d)return a[e]
        } else {
            a = +a;
            var f = b % a;
            if (d > f)return b - f;
            if (f > a - d)return b - f + a
        }
        return b
    }, c.createUUID = function (a, b) {
        return function () {
            return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(a, b).toUpperCase()
        }
    }(/[xy]/g, function (a) {
        var b = 0 | 16 * N.random(), c = "x" == a ? b : 8 | 3 & b;
        return c.toString(16)
    }), c.setWindow = function (a) {
        b("raphael.setWindow", c, A.win, a), A.win = a, A.doc = A.win.document, c._engine.initWin && c._engine.initWin(A.win)
    };
    var ub = function (a) {
        if (c.vml) {
            var b, d = /^\s+|\s+$/g;
            try {
                var e = new ActiveXObject("htmlfile");
                e.write("<body>"), e.close(), b = e.body
            } catch (g) {
                b = createPopup().document.body
            }
            var h = b.createTextRange();
            ub = f(function (a) {
                try {
                    b.style.color = I(a).replace(d, G);
                    var c = h.queryCommandValue("ForeColor");
                    return c = (255 & c) << 16 | 65280 & c | (16711680 & c) >>> 16, "#" + ("000000" + c.toString(16)).slice(-6)
                } catch (e) {
                    return "none"
                }
            })
        } else {
            var i = A.doc.createElement("i");
            i.title = "RaphaÃ«l Colour Picker", i.style.display = "none", A.doc.body.appendChild(i), ub = f(function (a) {
                return i.style.color = a, A.doc.defaultView.getComputedStyle(i, G).getPropertyValue("color")
            })
        }
        return ub(a)
    }, vb = function () {
        return "hsb(" + [this.h, this.s, this.b] + ")"
    }, wb = function () {
        return "hsl(" + [this.h, this.s, this.l] + ")"
    }, xb = function () {
        return this.hex
    }, yb = function (a, b, d) {
        if (null == b && c.is(a, "object") && "r"in a && "g"in a && "b"in a && (d = a.b, b = a.g, a = a.r), null == b && c.is(a, U)) {
            var e = c.getRGB(a);
            a = e.r, b = e.g, d = e.b
        }
        return (a > 1 || b > 1 || d > 1) && (a /= 255, b /= 255, d /= 255), [a, b, d]
    }, zb = function (a, b, d, e) {
        a *= 255, b *= 255, d *= 255;
        var f = {r: a, g: b, b: d, hex: c.rgb(a, b, d), toString: xb};
        return c.is(e, "finite") && (f.opacity = e), f
    };
    c.color = function (a) {
        var b;
        return c.is(a, "object") && "h"in a && "s"in a && "b"in a ? (b = c.hsb2rgb(a), a.r = b.r, a.g = b.g, a.b = b.b, a.hex = b.hex) : c.is(a, "object") && "h"in a && "s"in a && "l"in a ? (b = c.hsl2rgb(a), a.r = b.r, a.g = b.g, a.b = b.b, a.hex = b.hex) : (c.is(a, "string") && (a = c.getRGB(a)), c.is(a, "object") && "r"in a && "g"in a && "b"in a ? (b = c.rgb2hsl(a), a.h = b.h, a.s = b.s, a.l = b.l, b = c.rgb2hsb(a), a.v = b.b) : (a = {hex: "none"}, a.r = a.g = a.b = a.h = a.s = a.v = a.l = -1)), a.toString = xb, a
    }, c.hsb2rgb = function (a, b, c, d) {
        this.is(a, "object") && "h"in a && "s"in a && "b"in a && (c = a.b, b = a.s, a = a.h, d = a.o), a *= 360;
        var e, f, g, h, i;
        return a = a % 360 / 60, i = c * b, h = i * (1 - Q(a % 2 - 1)), e = f = g = c - i, a = ~~a, e += [i, h, 0, 0, h, i][a], f += [h, i, i, h, 0, 0][a], g += [0, 0, h, i, i, h][a], zb(e, f, g, d)
    }, c.hsl2rgb = function (a, b, c, d) {
        this.is(a, "object") && "h"in a && "s"in a && "l"in a && (c = a.l, b = a.s, a = a.h), (a > 1 || b > 1 || c > 1) && (a /= 360, b /= 100, c /= 100), a *= 360;
        var e, f, g, h, i;
        return a = a % 360 / 60, i = 2 * b * (.5 > c ? c : 1 - c), h = i * (1 - Q(a % 2 - 1)), e = f = g = c - i / 2, a = ~~a, e += [i, h, 0, 0, h, i][a], f += [h, i, i, h, 0, 0][a], g += [0, 0, h, i, i, h][a], zb(e, f, g, d)
    }, c.rgb2hsb = function (a, b, c) {
        c = yb(a, b, c), a = c[0], b = c[1], c = c[2];
        var d, e, f, g;
        return f = O(a, b, c), g = f - P(a, b, c), d = 0 == g ? null : f == a ? (b - c) / g : f == b ? (c - a) / g + 2 : (a - b) / g + 4, d = 60 * ((d + 360) % 6) / 360, e = 0 == g ? 0 : g / f, {
            h: d,
            s: e,
            b: f,
            toString: vb
        }
    }, c.rgb2hsl = function (a, b, c) {
        c = yb(a, b, c), a = c[0], b = c[1], c = c[2];
        var d, e, f, g, h, i;
        return g = O(a, b, c), h = P(a, b, c), i = g - h, d = 0 == i ? null : g == a ? (b - c) / i : g == b ? (c - a) / i + 2 : (a - b) / i + 4, d = 60 * ((d + 360) % 6) / 360, f = (g + h) / 2, e = 0 == i ? 0 : .5 > f ? i / (2 * f) : i / (2 - 2 * f), {
            h: d,
            s: e,
            l: f,
            toString: wb
        }
    }, c._path2string = function () {
        return this.join(",").replace(gb, "$1")
    }, c._preload = function (a, b) {
        var c = A.doc.createElement("img");
        c.style.cssText = "position:absolute;left:-9999em;top:-9999em", c.onload = function () {
            b.call(this), this.onload = null, A.doc.body.removeChild(this)
        }, c.onerror = function () {
            A.doc.body.removeChild(this)
        }, A.doc.body.appendChild(c), c.src = a
    }, c.getRGB = f(function (a) {
        if (!a || (a = I(a)).indexOf("-") + 1)return {r: -1, g: -1, b: -1, hex: "none", error: 1, toString: g};
        if ("none" == a)return {r: -1, g: -1, b: -1, hex: "none", toString: g};
        !(fb[z](a.toLowerCase().substring(0, 2)) || "#" == a.charAt()) && (a = ub(a));
        var b, d, e, f, h, i, j = a.match(X);
        return j ? (j[2] && (e = ab(j[2].substring(5), 16), d = ab(j[2].substring(3, 5), 16), b = ab(j[2].substring(1, 3), 16)), j[3] && (e = ab((h = j[3].charAt(3)) + h, 16), d = ab((h = j[3].charAt(2)) + h, 16), b = ab((h = j[3].charAt(1)) + h, 16)), j[4] && (i = j[4][J](eb), b = _(i[0]), "%" == i[0].slice(-1) && (b *= 2.55), d = _(i[1]), "%" == i[1].slice(-1) && (d *= 2.55), e = _(i[2]), "%" == i[2].slice(-1) && (e *= 2.55), "rgba" == j[1].toLowerCase().slice(0, 4) && (f = _(i[3])), i[3] && "%" == i[3].slice(-1) && (f /= 100)), j[5] ? (i = j[5][J](eb), b = _(i[0]), "%" == i[0].slice(-1) && (b *= 2.55), d = _(i[1]), "%" == i[1].slice(-1) && (d *= 2.55), e = _(i[2]), "%" == i[2].slice(-1) && (e *= 2.55), ("deg" == i[0].slice(-3) || "Â°" == i[0].slice(-1)) && (b /= 360), "hsba" == j[1].toLowerCase().slice(0, 4) && (f = _(i[3])), i[3] && "%" == i[3].slice(-1) && (f /= 100), c.hsb2rgb(b, d, e, f)) : j[6] ? (i = j[6][J](eb), b = _(i[0]), "%" == i[0].slice(-1) && (b *= 2.55), d = _(i[1]), "%" == i[1].slice(-1) && (d *= 2.55), e = _(i[2]), "%" == i[2].slice(-1) && (e *= 2.55), ("deg" == i[0].slice(-3) || "Â°" == i[0].slice(-1)) && (b /= 360), "hsla" == j[1].toLowerCase().slice(0, 4) && (f = _(i[3])), i[3] && "%" == i[3].slice(-1) && (f /= 100), c.hsl2rgb(b, d, e, f)) : (j = {
            r: b,
            g: d,
            b: e,
            toString: g
        }, j.hex = "#" + (16777216 | e | d << 8 | b << 16).toString(16).slice(1), c.is(f, "finite") && (j.opacity = f), j)) : {
            r: -1,
            g: -1,
            b: -1,
            hex: "none",
            error: 1,
            toString: g
        }
    }, c), c.hsb = f(function (a, b, d) {
        return c.hsb2rgb(a, b, d).hex
    }), c.hsl = f(function (a, b, d) {
        return c.hsl2rgb(a, b, d).hex
    }), c.rgb = f(function (a, b, c) {
        return "#" + (16777216 | c | b << 8 | a << 16).toString(16).slice(1)
    }), c.getColor = function (a) {
        var b = this.getColor.start = this.getColor.start || {h: 0, s: 1, b: a || .75}, c = this.hsb2rgb(b.h, b.s, b.b);
        return b.h += .075, b.h > 1 && (b.h = 0, b.s -= .2, b.s <= 0 && (this.getColor.start = {
            h: 0,
            s: 1,
            b: b.b
        })), c.hex
    }, c.getColor.reset = function () {
        delete this.start
    }, c.parsePathString = function (a) {
        if (!a)return null;
        var b = Ab(a);
        if (b.arr)return Cb(b.arr);
        var d = {a: 7, c: 6, h: 1, l: 2, m: 2, r: 4, q: 4, s: 4, t: 2, v: 1, z: 0}, e = [];
        return c.is(a, V) && c.is(a[0], V) && (e = Cb(a)), e.length || I(a).replace(hb, function (a, b, c) {
            var f = [], g = b.toLowerCase();
            if (c.replace(jb, function (a, b) {
                    b && f.push(+b)
                }), "m" == g && f.length > 2 && (e.push([b][E](f.splice(0, 2))), g = "l", b = "m" == b ? "l" : "L"), "r" == g)e.push([b][E](f)); else for (; f.length >= d[g] && (e.push([b][E](f.splice(0, d[g]))), d[g]););
        }), e.toString = c._path2string, b.arr = Cb(e), e
    }, c.parseTransformString = f(function (a) {
        if (!a)return null;
        var b = [];
        return c.is(a, V) && c.is(a[0], V) && (b = Cb(a)), b.length || I(a).replace(ib, function (a, c, d) {
            var e = [];
            M.call(c), d.replace(jb, function (a, b) {
                b && e.push(+b)
            }), b.push([c][E](e))
        }), b.toString = c._path2string, b
    });
    var Ab = function (a) {
        var b = Ab.ps = Ab.ps || {};
        return b[a] ? b[a].sleep = 100 : b[a] = {sleep: 100}, setTimeout(function () {
            for (var c in b)b[z](c) && c != a && (b[c].sleep--, !b[c].sleep && delete b[c])
        }), b[a]
    };
    c.findDotsAtSegment = function (a, b, c, d, e, f, g, h, i) {
        var j = 1 - i, k = R(j, 3), l = R(j, 2), m = i * i, n = m * i, o = k * a + 3 * l * i * c + 3 * j * i * i * e + n * g, p = k * b + 3 * l * i * d + 3 * j * i * i * f + n * h, q = a + 2 * i * (c - a) + m * (e - 2 * c + a), r = b + 2 * i * (d - b) + m * (f - 2 * d + b), s = c + 2 * i * (e - c) + m * (g - 2 * e + c), t = d + 2 * i * (f - d) + m * (h - 2 * f + d), u = j * a + i * c, v = j * b + i * d, w = j * e + i * g, x = j * f + i * h, y = 90 - 180 * N.atan2(q - s, r - t) / S;
        return (q > s || t > r) && (y += 180), {
            x: o,
            y: p,
            m: {x: q, y: r},
            n: {x: s, y: t},
            start: {x: u, y: v},
            end: {x: w, y: x},
            alpha: y
        }
    }, c.bezierBBox = function (a, b, d, e, f, g, h, i) {
        c.is(a, "array") || (a = [a, b, d, e, f, g, h, i]);
        var j = Jb.apply(null, a);
        return {x: j.min.x, y: j.min.y, x2: j.max.x, y2: j.max.y, width: j.max.x - j.min.x, height: j.max.y - j.min.y}
    }, c.isPointInsideBBox = function (a, b, c) {
        return b >= a.x && b <= a.x2 && c >= a.y && c <= a.y2
    }, c.isBBoxIntersect = function (a, b) {
        var d = c.isPointInsideBBox;
        return d(b, a.x, a.y) || d(b, a.x2, a.y) || d(b, a.x, a.y2) || d(b, a.x2, a.y2) || d(a, b.x, b.y) || d(a, b.x2, b.y) || d(a, b.x, b.y2) || d(a, b.x2, b.y2) || (a.x < b.x2 && a.x > b.x || b.x < a.x2 && b.x > a.x) && (a.y < b.y2 && a.y > b.y || b.y < a.y2 && b.y > a.y)
    }, c.pathIntersection = function (a, b) {
        return n(a, b)
    }, c.pathIntersectionNumber = function (a, b) {
        return n(a, b, 1)
    }, c.isPointInsidePath = function (a, b, d) {
        var e = c.pathBBox(a);
        return c.isPointInsideBBox(e, b, d) && 1 == n(a, [["M", b, d], ["H", e.x2 + 10]], 1) % 2
    }, c._removedFactory = function (a) {
        return function () {
            b("raphael.log", null, "RaphaÃ«l: you are calling to method â€œ" + a + "â€ of removed object", a)
        }
    };
    var Bb = c.pathBBox = function (a) {
        var b = Ab(a);
        if (b.bbox)return d(b.bbox);
        if (!a)return {x: 0, y: 0, width: 0, height: 0, x2: 0, y2: 0};
        a = Kb(a);
        for (var c, e = 0, f = 0, g = [], h = [], i = 0, j = a.length; j > i; i++)if (c = a[i], "M" == c[0])e = c[1], f = c[2], g.push(e), h.push(f); else {
            var k = Jb(e, f, c[1], c[2], c[3], c[4], c[5], c[6]);
            g = g[E](k.min.x, k.max.x), h = h[E](k.min.y, k.max.y), e = c[5], f = c[6]
        }
        var l = P[D](0, g), m = P[D](0, h), n = O[D](0, g), o = O[D](0, h), p = n - l, q = o - m, r = {
            x: l,
            y: m,
            x2: n,
            y2: o,
            width: p,
            height: q,
            cx: l + p / 2,
            cy: m + q / 2
        };
        return b.bbox = d(r), r
    }, Cb = function (a) {
        var b = d(a);
        return b.toString = c._path2string, b
    }, Db = c._pathToRelative = function (a) {
        var b = Ab(a);
        if (b.rel)return Cb(b.rel);
        c.is(a, V) && c.is(a && a[0], V) || (a = c.parsePathString(a));
        var d = [], e = 0, f = 0, g = 0, h = 0, i = 0;
        "M" == a[0][0] && (e = a[0][1], f = a[0][2], g = e, h = f, i++, d.push(["M", e, f]));
        for (var j = i, k = a.length; k > j; j++) {
            var l = d[j] = [], m = a[j];
            if (m[0] != M.call(m[0]))switch (l[0] = M.call(m[0]), l[0]) {
                case"a":
                    l[1] = m[1], l[2] = m[2], l[3] = m[3], l[4] = m[4], l[5] = m[5], l[6] = +(m[6] - e).toFixed(3), l[7] = +(m[7] - f).toFixed(3);
                    break;
                case"v":
                    l[1] = +(m[1] - f).toFixed(3);
                    break;
                case"m":
                    g = m[1], h = m[2];
                default:
                    for (var n = 1, o = m.length; o > n; n++)l[n] = +(m[n] - (n % 2 ? e : f)).toFixed(3)
            } else {
                l = d[j] = [], "m" == m[0] && (g = m[1] + e, h = m[2] + f);
                for (var p = 0, q = m.length; q > p; p++)d[j][p] = m[p]
            }
            var r = d[j].length;
            switch (d[j][0]) {
                case"z":
                    e = g, f = h;
                    break;
                case"h":
                    e += +d[j][r - 1];
                    break;
                case"v":
                    f += +d[j][r - 1];
                    break;
                default:
                    e += +d[j][r - 2], f += +d[j][r - 1]
            }
        }
        return d.toString = c._path2string, b.rel = Cb(d), d
    }, Eb = c._pathToAbsolute = function (a) {
        var b = Ab(a);
        if (b.abs)return Cb(b.abs);
        if (c.is(a, V) && c.is(a && a[0], V) || (a = c.parsePathString(a)), !a || !a.length)return [["M", 0, 0]];
        var d = [], e = 0, f = 0, g = 0, i = 0, j = 0;
        "M" == a[0][0] && (e = +a[0][1], f = +a[0][2], g = e, i = f, j++, d[0] = ["M", e, f]);
        for (var k, l, m = 3 == a.length && "M" == a[0][0] && "R" == a[1][0].toUpperCase() && "Z" == a[2][0].toUpperCase(), n = j, o = a.length; o > n; n++) {
            if (d.push(k = []), l = a[n], l[0] != bb.call(l[0]))switch (k[0] = bb.call(l[0]), k[0]) {
                case"A":
                    k[1] = l[1], k[2] = l[2], k[3] = l[3], k[4] = l[4], k[5] = l[5], k[6] = +(l[6] + e), k[7] = +(l[7] + f);
                    break;
                case"V":
                    k[1] = +l[1] + f;
                    break;
                case"H":
                    k[1] = +l[1] + e;
                    break;
                case"R":
                    for (var p = [e, f][E](l.slice(1)), q = 2, r = p.length; r > q; q++)p[q] = +p[q] + e, p[++q] = +p[q] + f;
                    d.pop(), d = d[E](h(p, m));
                    break;
                case"M":
                    g = +l[1] + e, i = +l[2] + f;
                default:
                    for (q = 1, r = l.length; r > q; q++)k[q] = +l[q] + (q % 2 ? e : f)
            } else if ("R" == l[0])p = [e, f][E](l.slice(1)), d.pop(), d = d[E](h(p, m)), k = ["R"][E](l.slice(-2)); else for (var s = 0, t = l.length; t > s; s++)k[s] = l[s];
            switch (k[0]) {
                case"Z":
                    e = g, f = i;
                    break;
                case"H":
                    e = k[1];
                    break;
                case"V":
                    f = k[1];
                    break;
                case"M":
                    g = k[k.length - 2], i = k[k.length - 1];
                default:
                    e = k[k.length - 2], f = k[k.length - 1]
            }
        }
        return d.toString = c._path2string, b.abs = Cb(d), d
    }, Fb = function (a, b, c, d) {
        return [a, b, c, d, c, d]
    }, Gb = function (a, b, c, d, e, f) {
        var g = 1 / 3, h = 2 / 3;
        return [g * a + h * c, g * b + h * d, g * e + h * c, g * f + h * d, e, f]
    }, Hb = function (a, b, c, d, e, g, h, i, j, k) {
        var l, m = 120 * S / 180, n = S / 180 * (+e || 0), o = [], p = f(function (a, b, c) {
            var d = a * N.cos(c) - b * N.sin(c), e = a * N.sin(c) + b * N.cos(c);
            return {x: d, y: e}
        });
        if (k)y = k[0], z = k[1], w = k[2], x = k[3]; else {
            l = p(a, b, -n), a = l.x, b = l.y, l = p(i, j, -n), i = l.x, j = l.y;
            var q = (N.cos(S / 180 * e), N.sin(S / 180 * e), (a - i) / 2), r = (b - j) / 2, s = q * q / (c * c) + r * r / (d * d);
            s > 1 && (s = N.sqrt(s), c = s * c, d = s * d);
            var t = c * c, u = d * d, v = (g == h ? -1 : 1) * N.sqrt(Q((t * u - t * r * r - u * q * q) / (t * r * r + u * q * q))), w = v * c * r / d + (a + i) / 2, x = v * -d * q / c + (b + j) / 2, y = N.asin(((b - x) / d).toFixed(9)), z = N.asin(((j - x) / d).toFixed(9));
            y = w > a ? S - y : y, z = w > i ? S - z : z, 0 > y && (y = 2 * S + y), 0 > z && (z = 2 * S + z), h && y > z && (y -= 2 * S), !h && z > y && (z -= 2 * S)
        }
        var A = z - y;
        if (Q(A) > m) {
            var B = z, C = i, D = j;
            z = y + m * (h && z > y ? 1 : -1), i = w + c * N.cos(z), j = x + d * N.sin(z), o = Hb(i, j, c, d, e, 0, h, C, D, [z, B, w, x])
        }
        A = z - y;
        var F = N.cos(y), G = N.sin(y), H = N.cos(z), I = N.sin(z), K = N.tan(A / 4), L = 4 / 3 * c * K, M = 4 / 3 * d * K, O = [a, b], P = [a + L * G, b - M * F], R = [i + L * I, j - M * H], T = [i, j];
        if (P[0] = 2 * O[0] - P[0], P[1] = 2 * O[1] - P[1], k)return [P, R, T][E](o);
        o = [P, R, T][E](o).join()[J](",");
        for (var U = [], V = 0, W = o.length; W > V; V++)U[V] = V % 2 ? p(o[V - 1], o[V], n).y : p(o[V], o[V + 1], n).x;
        return U
    }, Ib = function (a, b, c, d, e, f, g, h, i) {
        var j = 1 - i;
        return {
            x: R(j, 3) * a + 3 * R(j, 2) * i * c + 3 * j * i * i * e + R(i, 3) * g,
            y: R(j, 3) * b + 3 * R(j, 2) * i * d + 3 * j * i * i * f + R(i, 3) * h
        }
    }, Jb = f(function (a, b, c, d, e, f, g, h) {
        var i, j = e - 2 * c + a - (g - 2 * e + c), k = 2 * (c - a) - 2 * (e - c), l = a - c, m = (-k + N.sqrt(k * k - 4 * j * l)) / 2 / j, n = (-k - N.sqrt(k * k - 4 * j * l)) / 2 / j, o = [b, h], p = [a, g];
        return Q(m) > "1e12" && (m = .5), Q(n) > "1e12" && (n = .5), m > 0 && 1 > m && (i = Ib(a, b, c, d, e, f, g, h, m), p.push(i.x), o.push(i.y)), n > 0 && 1 > n && (i = Ib(a, b, c, d, e, f, g, h, n), p.push(i.x), o.push(i.y)), j = f - 2 * d + b - (h - 2 * f + d), k = 2 * (d - b) - 2 * (f - d), l = b - d, m = (-k + N.sqrt(k * k - 4 * j * l)) / 2 / j, n = (-k - N.sqrt(k * k - 4 * j * l)) / 2 / j, Q(m) > "1e12" && (m = .5), Q(n) > "1e12" && (n = .5), m > 0 && 1 > m && (i = Ib(a, b, c, d, e, f, g, h, m), p.push(i.x), o.push(i.y)), n > 0 && 1 > n && (i = Ib(a, b, c, d, e, f, g, h, n), p.push(i.x), o.push(i.y)), {
            min: {
                x: P[D](0, p),
                y: P[D](0, o)
            }, max: {x: O[D](0, p), y: O[D](0, o)}
        }
    }), Kb = c._path2curve = f(function (a, b) {
        var c = !b && Ab(a);
        if (!b && c.curve)return Cb(c.curve);
        for (var d = Eb(a), e = b && Eb(b), f = {x: 0, y: 0, bx: 0, by: 0, X: 0, Y: 0, qx: null, qy: null}, g = {
            x: 0,
            y: 0,
            bx: 0,
            by: 0,
            X: 0,
            Y: 0,
            qx: null,
            qy: null
        }, h = (function (a, b, c) {
            var d, e;
            if (!a)return ["C", b.x, b.y, b.x, b.y, b.x, b.y];
            switch (!(a[0]in{T: 1, Q: 1}) && (b.qx = b.qy = null), a[0]) {
                case"M":
                    b.X = a[1], b.Y = a[2];
                    break;
                case"A":
                    a = ["C"][E](Hb[D](0, [b.x, b.y][E](a.slice(1))));
                    break;
                case"S":
                    "C" == c || "S" == c ? (d = 2 * b.x - b.bx, e = 2 * b.y - b.by) : (d = b.x, e = b.y), a = ["C", d, e][E](a.slice(1));
                    break;
                case"T":
                    "Q" == c || "T" == c ? (b.qx = 2 * b.x - b.qx, b.qy = 2 * b.y - b.qy) : (b.qx = b.x, b.qy = b.y), a = ["C"][E](Gb(b.x, b.y, b.qx, b.qy, a[1], a[2]));
                    break;
                case"Q":
                    b.qx = a[1], b.qy = a[2], a = ["C"][E](Gb(b.x, b.y, a[1], a[2], a[3], a[4]));
                    break;
                case"L":
                    a = ["C"][E](Fb(b.x, b.y, a[1], a[2]));
                    break;
                case"H":
                    a = ["C"][E](Fb(b.x, b.y, a[1], b.y));
                    break;
                case"V":
                    a = ["C"][E](Fb(b.x, b.y, b.x, a[1]));
                    break;
                case"Z":
                    a = ["C"][E](Fb(b.x, b.y, b.X, b.Y))
            }
            return a
        }), i = function (a, b) {
            if (a[b].length > 7) {
                a[b].shift();
                for (var c = a[b]; c.length;)a.splice(b++, 0, ["C"][E](c.splice(0, 6)));
                a.splice(b, 1), l = O(d.length, e && e.length || 0)
            }
        }, j = function (a, b, c, f, g) {
            a && b && "M" == a[g][0] && "M" != b[g][0] && (b.splice(g, 0, ["M", f.x, f.y]), c.bx = 0, c.by = 0, c.x = a[g][1], c.y = a[g][2], l = O(d.length, e && e.length || 0))
        }, k = 0, l = O(d.length, e && e.length || 0); l > k; k++) {
            d[k] = h(d[k], f), i(d, k), e && (e[k] = h(e[k], g)), e && i(e, k), j(d, e, f, g, k), j(e, d, g, f, k);
            var m = d[k], n = e && e[k], o = m.length, p = e && n.length;
            f.x = m[o - 2], f.y = m[o - 1], f.bx = _(m[o - 4]) || f.x, f.by = _(m[o - 3]) || f.y, g.bx = e && (_(n[p - 4]) || g.x), g.by = e && (_(n[p - 3]) || g.y), g.x = e && n[p - 2], g.y = e && n[p - 1]
        }
        return e || (c.curve = Cb(d)), e ? [d, e] : d
    }, null, Cb), Lb = (c._parseDots = f(function (a) {
        for (var b = [], d = 0, e = a.length; e > d; d++) {
            var f = {}, g = a[d].match(/^([^:]*):?([\d\.]*)/);
            if (f.color = c.getRGB(g[1]), f.color.error)return null;
            f.color = f.color.hex, g[2] && (f.offset = g[2] + "%"), b.push(f)
        }
        for (d = 1, e = b.length - 1; e > d; d++)if (!b[d].offset) {
            for (var h = _(b[d - 1].offset || 0), i = 0, j = d + 1; e > j; j++)if (b[j].offset) {
                i = b[j].offset;
                break
            }
            i || (i = 100, j = e), i = _(i);
            for (var k = (i - h) / (j - d + 1); j > d; d++)h += k, b[d].offset = h + "%"
        }
        return b
    }), c._tear = function (a, b) {
        a == b.top && (b.top = a.prev), a == b.bottom && (b.bottom = a.next), a.next && (a.next.prev = a.prev), a.prev && (a.prev.next = a.next)
    }), Mb = (c._tofront = function (a, b) {
        b.top !== a && (Lb(a, b), a.next = null, a.prev = b.top, b.top.next = a, b.top = a)
    }, c._toback = function (a, b) {
        b.bottom !== a && (Lb(a, b), a.next = b.bottom, a.prev = null, b.bottom.prev = a, b.bottom = a)
    }, c._insertafter = function (a, b, c) {
        Lb(a, c), b == c.top && (c.top = a), b.next && (b.next.prev = a), a.next = b.next, a.prev = b, b.next = a
    }, c._insertbefore = function (a, b, c) {
        Lb(a, c), b == c.bottom && (c.bottom = a), b.prev && (b.prev.next = a), a.prev = b.prev, b.prev = a, a.next = b
    }, c.toMatrix = function (a, b) {
        var c = Bb(a), d = {
            _: {transform: G}, getBBox: function () {
                return c
            }
        };
        return Nb(d, b), d.matrix
    }), Nb = (c.transformPath = function (a, b) {
        return rb(a, Mb(a, b))
    }, c._extractTransform = function (a, b) {
        if (null == b)return a._.transform;
        b = I(b).replace(/\.{3}|\u2026/g, a._.transform || G);
        var d = c.parseTransformString(b), e = 0, f = 0, g = 0, h = 1, i = 1, j = a._, k = new o;
        if (j.transform = d || [], d)for (var l = 0, m = d.length; m > l; l++) {
            var n, p, q, r, s, t = d[l], u = t.length, v = I(t[0]).toLowerCase(), w = t[0] != v, x = w ? k.invert() : 0;
            "t" == v && 3 == u ? w ? (n = x.x(0, 0), p = x.y(0, 0), q = x.x(t[1], t[2]), r = x.y(t[1], t[2]), k.translate(q - n, r - p)) : k.translate(t[1], t[2]) : "r" == v ? 2 == u ? (s = s || a.getBBox(1), k.rotate(t[1], s.x + s.width / 2, s.y + s.height / 2), e += t[1]) : 4 == u && (w ? (q = x.x(t[2], t[3]), r = x.y(t[2], t[3]), k.rotate(t[1], q, r)) : k.rotate(t[1], t[2], t[3]), e += t[1]) : "s" == v ? 2 == u || 3 == u ? (s = s || a.getBBox(1), k.scale(t[1], t[u - 1], s.x + s.width / 2, s.y + s.height / 2), h *= t[1], i *= t[u - 1]) : 5 == u && (w ? (q = x.x(t[3], t[4]), r = x.y(t[3], t[4]), k.scale(t[1], t[2], q, r)) : k.scale(t[1], t[2], t[3], t[4]), h *= t[1], i *= t[2]) : "m" == v && 7 == u && k.add(t[1], t[2], t[3], t[4], t[5], t[6]), j.dirtyT = 1, a.matrix = k
        }
        a.matrix = k, j.sx = h, j.sy = i, j.deg = e, j.dx = f = k.e, j.dy = g = k.f, 1 == h && 1 == i && !e && j.bbox ? (j.bbox.x += +f, j.bbox.y += +g) : j.dirtyT = 1
    }), Ob = function (a) {
        var b = a[0];
        switch (b.toLowerCase()) {
            case"t":
                return [b, 0, 0];
            case"m":
                return [b, 1, 0, 0, 1, 0, 0];
            case"r":
                return 4 == a.length ? [b, 0, a[2], a[3]] : [b, 0];
            case"s":
                return 5 == a.length ? [b, 1, 1, a[3], a[4]] : 3 == a.length ? [b, 1, 1] : [b, 1]
        }
    }, Pb = c._equaliseTransform = function (a, b) {
        b = I(b).replace(/\.{3}|\u2026/g, a), a = c.parseTransformString(a) || [], b = c.parseTransformString(b) || [];
        for (var d, e, f, g, h = O(a.length, b.length), i = [], j = [], k = 0; h > k; k++) {
            if (f = a[k] || Ob(b[k]), g = b[k] || Ob(f), f[0] != g[0] || "r" == f[0].toLowerCase() && (f[2] != g[2] || f[3] != g[3]) || "s" == f[0].toLowerCase() && (f[3] != g[3] || f[4] != g[4]))return;
            for (i[k] = [], j[k] = [], d = 0, e = O(f.length, g.length); e > d; d++)d in f && (i[k][d] = f[d]), d in g && (j[k][d] = g[d])
        }
        return {from: i, to: j}
    };
    c._getContainer = function (a, b, d, e) {
        var f;
        return f = null != e || c.is(a, "object") ? a : A.doc.getElementById(a), null != f ? f.tagName ? null == b ? {
            container: f,
            width: f.style.pixelWidth || f.offsetWidth,
            height: f.style.pixelHeight || f.offsetHeight
        } : {container: f, width: b, height: d} : {container: 1, x: a, y: b, width: d, height: e} : void 0
    }, c.pathToRelative = Db, c._engine = {}, c.path2curve = Kb, c.matrix = function (a, b, c, d, e, f) {
        return new o(a, b, c, d, e, f)
    }, function (a) {
        function b(a) {
            return a[0] * a[0] + a[1] * a[1]
        }

        function d(a) {
            var c = N.sqrt(b(a));
            a[0] && (a[0] /= c), a[1] && (a[1] /= c)
        }

        a.add = function (a, b, c, d, e, f) {
            var g, h, i, j, k = [[], [], []], l = [[this.a, this.c, this.e], [this.b, this.d, this.f], [0, 0, 1]], m = [[a, c, e], [b, d, f], [0, 0, 1]];
            for (a && a instanceof o && (m = [[a.a, a.c, a.e], [a.b, a.d, a.f], [0, 0, 1]]), g = 0; 3 > g; g++)for (h = 0; 3 > h; h++) {
                for (j = 0, i = 0; 3 > i; i++)j += l[g][i] * m[i][h];
                k[g][h] = j
            }
            this.a = k[0][0], this.b = k[1][0], this.c = k[0][1], this.d = k[1][1], this.e = k[0][2], this.f = k[1][2]
        }, a.invert = function () {
            var a = this, b = a.a * a.d - a.b * a.c;
            return new o(a.d / b, -a.b / b, -a.c / b, a.a / b, (a.c * a.f - a.d * a.e) / b, (a.b * a.e - a.a * a.f) / b)
        }, a.clone = function () {
            return new o(this.a, this.b, this.c, this.d, this.e, this.f)
        }, a.translate = function (a, b) {
            this.add(1, 0, 0, 1, a, b)
        }, a.scale = function (a, b, c, d) {
            null == b && (b = a), (c || d) && this.add(1, 0, 0, 1, c, d), this.add(a, 0, 0, b, 0, 0), (c || d) && this.add(1, 0, 0, 1, -c, -d)
        }, a.rotate = function (a, b, d) {
            a = c.rad(a), b = b || 0, d = d || 0;
            var e = +N.cos(a).toFixed(9), f = +N.sin(a).toFixed(9);
            this.add(e, f, -f, e, b, d), this.add(1, 0, 0, 1, -b, -d)
        }, a.x = function (a, b) {
            return a * this.a + b * this.c + this.e
        }, a.y = function (a, b) {
            return a * this.b + b * this.d + this.f
        }, a.get = function (a) {
            return +this[I.fromCharCode(97 + a)].toFixed(4)
        }, a.toString = function () {
            return c.svg ? "matrix(" + [this.get(0), this.get(1), this.get(2), this.get(3), this.get(4), this.get(5)].join() + ")" : [this.get(0), this.get(2), this.get(1), this.get(3), 0, 0].join()
        }, a.toFilter = function () {
            return "progid:DXImageTransform.Microsoft.Matrix(M11=" + this.get(0) + ", M12=" + this.get(2) + ", M21=" + this.get(1) + ", M22=" + this.get(3) + ", Dx=" + this.get(4) + ", Dy=" + this.get(5) + ", sizingmethod='auto expand')"
        }, a.offset = function () {
            return [this.e.toFixed(4), this.f.toFixed(4)]
        }, a.split = function () {
            var a = {};
            a.dx = this.e, a.dy = this.f;
            var e = [[this.a, this.c], [this.b, this.d]];
            a.scalex = N.sqrt(b(e[0])), d(e[0]), a.shear = e[0][0] * e[1][0] + e[0][1] * e[1][1], e[1] = [e[1][0] - e[0][0] * a.shear, e[1][1] - e[0][1] * a.shear], a.scaley = N.sqrt(b(e[1])), d(e[1]), a.shear /= a.scaley;
            var f = -e[0][1], g = e[1][1];
            return 0 > g ? (a.rotate = c.deg(N.acos(g)), 0 > f && (a.rotate = 360 - a.rotate)) : a.rotate = c.deg(N.asin(f)), a.isSimple = !(+a.shear.toFixed(9) || a.scalex.toFixed(9) != a.scaley.toFixed(9) && a.rotate), a.isSuperSimple = !+a.shear.toFixed(9) && a.scalex.toFixed(9) == a.scaley.toFixed(9) && !a.rotate, a.noRotation = !+a.shear.toFixed(9) && !a.rotate, a
        }, a.toTransformString = function (a) {
            var b = a || this[J]();
            return b.isSimple ? (b.scalex = +b.scalex.toFixed(4), b.scaley = +b.scaley.toFixed(4), b.rotate = +b.rotate.toFixed(4), (b.dx || b.dy ? "t" + [b.dx, b.dy] : G) + (1 != b.scalex || 1 != b.scaley ? "s" + [b.scalex, b.scaley, 0, 0] : G) + (b.rotate ? "r" + [b.rotate, 0, 0] : G)) : "m" + [this.get(0), this.get(1), this.get(2), this.get(3), this.get(4), this.get(5)]
        }
    }(o.prototype);
    var Qb = navigator.userAgent.match(/Version\/(.*?)\s/) || navigator.userAgent.match(/Chrome\/(\d+)/);
    v.safari = "Apple Computer, Inc." == navigator.vendor && (Qb && Qb[1] < 4 || "iP" == navigator.platform.slice(0, 2)) || "Google Inc." == navigator.vendor && Qb && Qb[1] < 8 ? function () {
        var a = this.rect(-99, -99, this.width + 99, this.height + 99).attr({stroke: "none"});
        setTimeout(function () {
            a.remove()
        })
    } : mb;
    for (var Rb = function () {
        this.returnValue = !1
    }, Sb = function () {
        return this.originalEvent.preventDefault()
    }, Tb = function () {
        this.cancelBubble = !0
    }, Ub = function () {
        return this.originalEvent.stopPropagation()
    }, Vb = function (a) {
        var b = A.doc.documentElement.scrollTop || A.doc.body.scrollTop, c = A.doc.documentElement.scrollLeft || A.doc.body.scrollLeft;
        return {x: a.clientX + c, y: a.clientY + b}
    }, Wb = function () {
        return A.doc.addEventListener ? function (a, b, c, d) {
            var e = function (a) {
                var b = Vb(a);
                return c.call(d, a, b.x, b.y)
            };
            if (a.addEventListener(b, e, !1), F && L[b]) {
                var f = function (b) {
                    for (var e = Vb(b), f = b, g = 0, h = b.targetTouches && b.targetTouches.length; h > g; g++)if (b.targetTouches[g].target == a) {
                        b = b.targetTouches[g], b.originalEvent = f, b.preventDefault = Sb, b.stopPropagation = Ub;
                        break
                    }
                    return c.call(d, b, e.x, e.y)
                };
                a.addEventListener(L[b], f, !1)
            }
            return function () {
                return a.removeEventListener(b, e, !1), F && L[b] && a.removeEventListener(L[b], e, !1), !0
            }
        } : A.doc.attachEvent ? function (a, b, c, d) {
            var e = function (a) {
                a = a || A.win.event;
                var b = A.doc.documentElement.scrollTop || A.doc.body.scrollTop, e = A.doc.documentElement.scrollLeft || A.doc.body.scrollLeft, f = a.clientX + e, g = a.clientY + b;
                return a.preventDefault = a.preventDefault || Rb, a.stopPropagation = a.stopPropagation || Tb, c.call(d, a, f, g)
            };
            a.attachEvent("on" + b, e);
            var f = function () {
                return a.detachEvent("on" + b, e), !0
            };
            return f
        } : void 0
    }(), Xb = [], Yb = function (a) {
        for (var c, d = a.clientX, e = a.clientY, f = A.doc.documentElement.scrollTop || A.doc.body.scrollTop, g = A.doc.documentElement.scrollLeft || A.doc.body.scrollLeft, h = Xb.length; h--;) {
            if (c = Xb[h], F && a.touches) {
                for (var i, j = a.touches.length; j--;)if (i = a.touches[j], i.identifier == c.el._drag.id) {
                    d = i.clientX, e = i.clientY, (a.originalEvent ? a.originalEvent : a).preventDefault();
                    break
                }
            } else a.preventDefault();
            var k, l = c.el.node, m = l.nextSibling, n = l.parentNode, o = l.style.display;
            A.win.opera && n.removeChild(l), l.style.display = "none", k = c.el.paper.getElementByPoint(d, e), l.style.display = o, A.win.opera && (m ? n.insertBefore(l, m) : n.appendChild(l)), k && b("raphael.drag.over." + c.el.id, c.el, k), d += g, e += f, b("raphael.drag.move." + c.el.id, c.move_scope || c.el, d - c.el._drag.x, e - c.el._drag.y, d, e, a)
        }
    }, Zb = function (a) {
        c.unmousemove(Yb).unmouseup(Zb);
        for (var d, e = Xb.length; e--;)d = Xb[e], d.el._drag = {}, b("raphael.drag.end." + d.el.id, d.end_scope || d.start_scope || d.move_scope || d.el, a);
        Xb = []
    }, $b = c.el = {}, _b = K.length; _b--;)!function (a) {
        c[a] = $b[a] = function (b, d) {
            return c.is(b, "function") && (this.events = this.events || [], this.events.push({
                name: a,
                f: b,
                unbind: Wb(this.shape || this.node || A.doc, a, b, d || this)
            })), this
        }, c["un" + a] = $b["un" + a] = function (b) {
            for (var d = this.events || [], e = d.length; e--;)d[e].name != a || !c.is(b, "undefined") && d[e].f != b || (d[e].unbind(), d.splice(e, 1), !d.length && delete this.events);
            return this
        }
    }(K[_b]);
    $b.data = function (a, d) {
        var e = kb[this.id] = kb[this.id] || {};
        if (0 == arguments.length)return e;
        if (1 == arguments.length) {
            if (c.is(a, "object")) {
                for (var f in a)a[z](f) && this.data(f, a[f]);
                return this
            }
            return b("raphael.data.get." + this.id, this, e[a], a), e[a]
        }
        return e[a] = d, b("raphael.data.set." + this.id, this, d, a), this
    }, $b.removeData = function (a) {
        return null == a ? kb[this.id] = {} : kb[this.id] && delete kb[this.id][a], this
    }, $b.getData = function () {
        return d(kb[this.id] || {})
    }, $b.hover = function (a, b, c, d) {
        return this.mouseover(a, c).mouseout(b, d || c)
    }, $b.unhover = function (a, b) {
        return this.unmouseover(a).unmouseout(b)
    };
    var ac = [];
    $b.drag = function (a, d, e, f, g, h) {
        function i(i) {
            (i.originalEvent || i).preventDefault();
            var j = i.clientX, k = i.clientY, l = A.doc.documentElement.scrollTop || A.doc.body.scrollTop, m = A.doc.documentElement.scrollLeft || A.doc.body.scrollLeft;
            if (this._drag.id = i.identifier, F && i.touches)for (var n, o = i.touches.length; o--;)if (n = i.touches[o], this._drag.id = n.identifier, n.identifier == this._drag.id) {
                j = n.clientX, k = n.clientY;
                break
            }
            this._drag.x = j + m, this._drag.y = k + l, !Xb.length && c.mousemove(Yb).mouseup(Zb), Xb.push({
                el: this,
                move_scope: f,
                start_scope: g,
                end_scope: h
            }), d && b.on("raphael.drag.start." + this.id, d), a && b.on("raphael.drag.move." + this.id, a), e && b.on("raphael.drag.end." + this.id, e), b("raphael.drag.start." + this.id, g || f || this, i.clientX + m, i.clientY + l, i)
        }

        return this._drag = {}, ac.push({el: this, start: i}), this.mousedown(i), this
    }, $b.onDragOver = function (a) {
        a ? b.on("raphael.drag.over." + this.id, a) : b.unbind("raphael.drag.over." + this.id)
    }, $b.undrag = function () {
        for (var a = ac.length; a--;)ac[a].el == this && (this.unmousedown(ac[a].start), ac.splice(a, 1), b.unbind("raphael.drag.*." + this.id));
        !ac.length && c.unmousemove(Yb).unmouseup(Zb), Xb = []
    }, v.circle = function (a, b, d) {
        var e = c._engine.circle(this, a || 0, b || 0, d || 0);
        return this.__set__ && this.__set__.push(e), e
    }, v.rect = function (a, b, d, e, f) {
        var g = c._engine.rect(this, a || 0, b || 0, d || 0, e || 0, f || 0);
        return this.__set__ && this.__set__.push(g), g
    }, v.ellipse = function (a, b, d, e) {
        var f = c._engine.ellipse(this, a || 0, b || 0, d || 0, e || 0);
        return this.__set__ && this.__set__.push(f), f
    }, v.path = function (a) {
        a && !c.is(a, U) && !c.is(a[0], V) && (a += G);
        var b = c._engine.path(c.format[D](c, arguments), this);
        return this.__set__ && this.__set__.push(b), b
    }, v.image = function (a, b, d, e, f) {
        var g = c._engine.image(this, a || "about:blank", b || 0, d || 0, e || 0, f || 0);
        return this.__set__ && this.__set__.push(g), g
    }, v.text = function (a, b, d) {
        var e = c._engine.text(this, a || 0, b || 0, I(d));
        return this.__set__ && this.__set__.push(e), e
    }, v.set = function (a) {
        !c.is(a, "array") && (a = Array.prototype.splice.call(arguments, 0, arguments.length));
        var b = new mc(a);
        return this.__set__ && this.__set__.push(b), b.paper = this, b.type = "set", b
    }, v.setStart = function (a) {
        this.__set__ = a || this.set()
    }, v.setFinish = function () {
        var a = this.__set__;
        return delete this.__set__, a
    }, v.setSize = function (a, b) {
        return c._engine.setSize.call(this, a, b)
    }, v.setViewBox = function (a, b, d, e, f) {
        return c._engine.setViewBox.call(this, a, b, d, e, f)
    }, v.top = v.bottom = null, v.raphael = c;
    var bc = function (a) {
        var b = a.getBoundingClientRect(), c = a.ownerDocument, d = c.body, e = c.documentElement, f = e.clientTop || d.clientTop || 0, g = e.clientLeft || d.clientLeft || 0, h = b.top + (A.win.pageYOffset || e.scrollTop || d.scrollTop) - f, i = b.left + (A.win.pageXOffset || e.scrollLeft || d.scrollLeft) - g;
        return {y: h, x: i}
    };
    v.getElementByPoint = function (a, b) {
        var c = this, d = c.canvas, e = A.doc.elementFromPoint(a, b);
        if (A.win.opera && "svg" == e.tagName) {
            var f = bc(d), g = d.createSVGRect();
            g.x = a - f.x, g.y = b - f.y, g.width = g.height = 1;
            var h = d.getIntersectionList(g, null);
            h.length && (e = h[h.length - 1])
        }
        if (!e)return null;
        for (; e.parentNode && e != d.parentNode && !e.raphael;)e = e.parentNode;
        return e == c.canvas.parentNode && (e = d), e = e && e.raphael ? c.getById(e.raphaelid) : null
    }, v.getElementsByBBox = function (a) {
        var b = this.set();
        return this.forEach(function (d) {
            c.isBBoxIntersect(d.getBBox(), a) && b.push(d)
        }), b
    }, v.getById = function (a) {
        for (var b = this.bottom; b;) {
            if (b.id == a)return b;
            b = b.next
        }
        return null
    }, v.forEach = function (a, b) {
        for (var c = this.bottom; c;) {
            if (a.call(b, c) === !1)return this;
            c = c.next
        }
        return this
    }, v.getElementsByPoint = function (a, b) {
        var c = this.set();
        return this.forEach(function (d) {
            d.isPointInside(a, b) && c.push(d)
        }), c
    }, $b.isPointInside = function (a, b) {
        var d = this.realPath = qb[this.type](this);
        return this.attr("transform") && this.attr("transform").length && (d = c.transformPath(d, this.attr("transform"))), c.isPointInsidePath(d, a, b)
    }, $b.getBBox = function (a) {
        if (this.removed)return {};
        var b = this._;
        return a ? ((b.dirty || !b.bboxwt) && (this.realPath = qb[this.type](this), b.bboxwt = Bb(this.realPath), b.bboxwt.toString = p, b.dirty = 0), b.bboxwt) : ((b.dirty || b.dirtyT || !b.bbox) && ((b.dirty || !this.realPath) && (b.bboxwt = 0, this.realPath = qb[this.type](this)), b.bbox = Bb(rb(this.realPath, this.matrix)), b.bbox.toString = p, b.dirty = b.dirtyT = 0), b.bbox)
    }, $b.clone = function () {
        if (this.removed)return null;
        var a = this.paper[this.type]().attr(this.attr());
        return this.__set__ && this.__set__.push(a), a
    }, $b.glow = function (a) {
        if ("text" == this.type)return null;
        a = a || {};
        var b = {
            width: (a.width || 10) + (+this.attr("stroke-width") || 1),
            fill: a.fill || !1,
            opacity: a.opacity || .5,
            offsetx: a.offsetx || 0,
            offsety: a.offsety || 0,
            color: a.color || "#000"
        }, c = b.width / 2, d = this.paper, e = d.set(), f = this.realPath || qb[this.type](this);
        f = this.matrix ? rb(f, this.matrix) : f;
        for (var g = 1; c + 1 > g; g++)e.push(d.path(f).attr({
            stroke: b.color,
            fill: b.fill ? b.color : "none",
            "stroke-linejoin": "round",
            "stroke-linecap": "round",
            "stroke-width": +(b.width / c * g).toFixed(3),
            opacity: +(b.opacity / c).toFixed(3)
        }));
        return e.insertBefore(this).translate(b.offsetx, b.offsety)
    };
    var cc = function (a, b, d, e, f, g, h, i, l) {
        return null == l ? j(a, b, d, e, f, g, h, i) : c.findDotsAtSegment(a, b, d, e, f, g, h, i, k(a, b, d, e, f, g, h, i, l))
    }, dc = function (a, b) {
        return function (d, e, f) {
            d = Kb(d);
            for (var g, h, i, j, k, l = "", m = {}, n = 0, o = 0, p = d.length; p > o; o++) {
                if (i = d[o], "M" == i[0])g = +i[1], h = +i[2]; else {
                    if (j = cc(g, h, i[1], i[2], i[3], i[4], i[5], i[6]), n + j > e) {
                        if (b && !m.start) {
                            if (k = cc(g, h, i[1], i[2], i[3], i[4], i[5], i[6], e - n), l += ["C" + k.start.x, k.start.y, k.m.x, k.m.y, k.x, k.y], f)return l;
                            m.start = l, l = ["M" + k.x, k.y + "C" + k.n.x, k.n.y, k.end.x, k.end.y, i[5], i[6]].join(), n += j, g = +i[5], h = +i[6];
                            continue
                        }
                        if (!a && !b)return k = cc(g, h, i[1], i[2], i[3], i[4], i[5], i[6], e - n), {
                            x: k.x,
                            y: k.y,
                            alpha: k.alpha
                        }
                    }
                    n += j, g = +i[5], h = +i[6]
                }
                l += i.shift() + i
            }
            return m.end = l, k = a ? n : b ? m : c.findDotsAtSegment(g, h, i[0], i[1], i[2], i[3], i[4], i[5], 1), k.alpha && (k = {
                x: k.x,
                y: k.y,
                alpha: k.alpha
            }), k
        }
    }, ec = dc(1), fc = dc(), gc = dc(0, 1);
    c.getTotalLength = ec, c.getPointAtLength = fc, c.getSubpath = function (a, b, c) {
        if (this.getTotalLength(a) - c < 1e-6)return gc(a, b).end;
        var d = gc(a, c, 1);
        return b ? gc(d, b).end : d
    }, $b.getTotalLength = function () {
        var a = this.getPath();
        if (a)return this.node.getTotalLength ? this.node.getTotalLength() : ec(a)
    }, $b.getPointAtLength = function (a) {
        var b = this.getPath();
        if (b)return fc(b, a)
    }, $b.getPath = function () {
        var a, b = c._getPath[this.type];
        if ("text" != this.type && "set" != this.type)return b && (a = b(this)), a
    }, $b.getSubpath = function (a, b) {
        var d = this.getPath();
        if (d)return c.getSubpath(d, a, b)
    };
    var hc = c.easing_formulas = {
        linear: function (a) {
            return a
        }, "<": function (a) {
            return R(a, 1.7)
        }, ">": function (a) {
            return R(a, .48)
        }, "<>": function (a) {
            var b = .48 - a / 1.04, c = N.sqrt(.1734 + b * b), d = c - b, e = R(Q(d), 1 / 3) * (0 > d ? -1 : 1), f = -c - b, g = R(Q(f), 1 / 3) * (0 > f ? -1 : 1), h = e + g + .5;
            return 3 * (1 - h) * h * h + h * h * h
        }, backIn: function (a) {
            var b = 1.70158;
            return a * a * ((b + 1) * a - b)
        }, backOut: function (a) {
            a -= 1;
            var b = 1.70158;
            return a * a * ((b + 1) * a + b) + 1
        }, elastic: function (a) {
            return a == !!a ? a : R(2, -10 * a) * N.sin((a - .075) * 2 * S / .3) + 1
        }, bounce: function (a) {
            var b, c = 7.5625, d = 2.75;
            return 1 / d > a ? b = c * a * a : 2 / d > a ? (a -= 1.5 / d, b = c * a * a + .75) : 2.5 / d > a ? (a -= 2.25 / d, b = c * a * a + .9375) : (a -= 2.625 / d, b = c * a * a + .984375), b
        }
    };
    hc.easeIn = hc["ease-in"] = hc["<"], hc.easeOut = hc["ease-out"] = hc[">"], hc.easeInOut = hc["ease-in-out"] = hc["<>"], hc["back-in"] = hc.backIn, hc["back-out"] = hc.backOut;
    var ic = [], jc = a.requestAnimationFrame || a.webkitRequestAnimationFrame || a.mozRequestAnimationFrame || a.oRequestAnimationFrame || a.msRequestAnimationFrame || function (a) {
            setTimeout(a, 16)
        }, kc = function () {
        for (var a = +new Date, d = 0; d < ic.length; d++) {
            var e = ic[d];
            if (!e.el.removed && !e.paused) {
                var f, g, h = a - e.start, i = e.ms, j = e.easing, k = e.from, l = e.diff, m = e.to, n = (e.t, e.el), o = {}, p = {};
                if (e.initstatus ? (h = (e.initstatus * e.anim.top - e.prev) / (e.percent - e.prev) * i, e.status = e.initstatus, delete e.initstatus, e.stop && ic.splice(d--, 1)) : e.status = (e.prev + (e.percent - e.prev) * (h / i)) / e.anim.top, !(0 > h))if (i > h) {
                    var q = j(h / i);
                    for (var r in k)if (k[z](r)) {
                        switch (db[r]) {
                            case T:
                                f = +k[r] + q * i * l[r];
                                break;
                            case"colour":
                                f = "rgb(" + [lc($(k[r].r + q * i * l[r].r)), lc($(k[r].g + q * i * l[r].g)), lc($(k[r].b + q * i * l[r].b))].join(",") + ")";
                                break;
                            case"path":
                                f = [];
                                for (var t = 0, u = k[r].length; u > t; t++) {
                                    f[t] = [k[r][t][0]];
                                    for (var v = 1, w = k[r][t].length; w > v; v++)f[t][v] = +k[r][t][v] + q * i * l[r][t][v];
                                    f[t] = f[t].join(H)
                                }
                                f = f.join(H);
                                break;
                            case"transform":
                                if (l[r].real)for (f = [], t = 0, u = k[r].length; u > t; t++)for (f[t] = [k[r][t][0]], v = 1, w = k[r][t].length; w > v; v++)f[t][v] = k[r][t][v] + q * i * l[r][t][v]; else {
                                    var x = function (a) {
                                        return +k[r][a] + q * i * l[r][a]
                                    };
                                    f = [["m", x(0), x(1), x(2), x(3), x(4), x(5)]]
                                }
                                break;
                            case"csv":
                                if ("clip-rect" == r)for (f = [], t = 4; t--;)f[t] = +k[r][t] + q * i * l[r][t];
                                break;
                            default:
                                var y = [][E](k[r]);
                                for (f = [], t = n.paper.customAttributes[r].length; t--;)f[t] = +y[t] + q * i * l[r][t]
                        }
                        o[r] = f
                    }
                    n.attr(o), function (a, c, d) {
                        setTimeout(function () {
                            b("raphael.anim.frame." + a, c, d)
                        })
                    }(n.id, n, e.anim)
                } else {
                    if (function (a, d, e) {
                            setTimeout(function () {
                                b("raphael.anim.frame." + d.id, d, e), b("raphael.anim.finish." + d.id, d, e), c.is(a, "function") && a.call(d)
                            })
                        }(e.callback, n, e.anim), n.attr(m), ic.splice(d--, 1), e.repeat > 1 && !e.next) {
                        for (g in m)m[z](g) && (p[g] = e.totalOrigin[g]);
                        e.el.attr(p), s(e.anim, e.el, e.anim.percents[0], null, e.totalOrigin, e.repeat - 1)
                    }
                    e.next && !e.stop && s(e.anim, e.el, e.next, null, e.totalOrigin, e.repeat)
                }
            }
        }
        c.svg && n && n.paper && n.paper.safari(), ic.length && jc(kc)
    }, lc = function (a) {
        return a > 255 ? 255 : 0 > a ? 0 : a
    };
    $b.animateWith = function (a, b, d, e, f, g) {
        var h = this;
        if (h.removed)return g && g.call(h), h;
        var i = d instanceof r ? d : c.animation(d, e, f, g);
        s(i, h, i.percents[0], null, h.attr());
        for (var j = 0, k = ic.length; k > j; j++)if (ic[j].anim == b && ic[j].el == a) {
            ic[k - 1].start = ic[j].start;
            break
        }
        return h
    }, $b.onAnimation = function (a) {
        return a ? b.on("raphael.anim.frame." + this.id, a) : b.unbind("raphael.anim.frame." + this.id), this
    }, r.prototype.delay = function (a) {
        var b = new r(this.anim, this.ms);
        return b.times = this.times, b.del = +a || 0, b
    }, r.prototype.repeat = function (a) {
        var b = new r(this.anim, this.ms);
        return b.del = this.del, b.times = N.floor(O(a, 0)) || 1, b
    }, c.animation = function (a, b, d, e) {
        if (a instanceof r)return a;
        (c.is(d, "function") || !d) && (e = e || d || null, d = null), a = Object(a), b = +b || 0;
        var f, g, h = {};
        for (g in a)a[z](g) && _(g) != g && _(g) + "%" != g && (f = !0, h[g] = a[g]);
        return f ? (d && (h.easing = d), e && (h.callback = e), new r({100: h}, b)) : new r(a, b)
    }, $b.animate = function (a, b, d, e) {
        var f = this;
        if (f.removed)return e && e.call(f), f;
        var g = a instanceof r ? a : c.animation(a, b, d, e);
        return s(g, f, g.percents[0], null, f.attr()), f
    }, $b.setTime = function (a, b) {
        return a && null != b && this.status(a, P(b, a.ms) / a.ms), this
    }, $b.status = function (a, b) {
        var c, d, e = [], f = 0;
        if (null != b)return s(a, this, -1, P(b, 1)), this;
        for (c = ic.length; c > f; f++)if (d = ic[f], d.el.id == this.id && (!a || d.anim == a)) {
            if (a)return d.status;
            e.push({anim: d.anim, status: d.status})
        }
        return a ? 0 : e
    }, $b.pause = function (a) {
        for (var c = 0; c < ic.length; c++)ic[c].el.id != this.id || a && ic[c].anim != a || b("raphael.anim.pause." + this.id, this, ic[c].anim) !== !1 && (ic[c].paused = !0);
        return this
    }, $b.resume = function (a) {
        for (var c = 0; c < ic.length; c++)if (ic[c].el.id == this.id && (!a || ic[c].anim == a)) {
            var d = ic[c];
            b("raphael.anim.resume." + this.id, this, d.anim) !== !1 && (delete d.paused, this.status(d.anim, d.status))
        }
        return this
    }, $b.stop = function (a) {
        for (var c = 0; c < ic.length; c++)ic[c].el.id != this.id || a && ic[c].anim != a || b("raphael.anim.stop." + this.id, this, ic[c].anim) !== !1 && ic.splice(c--, 1);
        return this
    }, b.on("raphael.remove", t), b.on("raphael.clear", t), $b.toString = function () {
        return "RaphaÃ«lâ€™s object"
    };
    var mc = function (a) {
        if (this.items = [], this.length = 0, this.type = "set", a)for (var b = 0, c = a.length; c > b; b++)!a[b] || a[b].constructor != $b.constructor && a[b].constructor != mc || (this[this.items.length] = this.items[this.items.length] = a[b], this.length++)
    }, nc = mc.prototype;
    nc.push = function () {
        for (var a, b, c = 0, d = arguments.length; d > c; c++)a = arguments[c], !a || a.constructor != $b.constructor && a.constructor != mc || (b = this.items.length, this[b] = this.items[b] = a, this.length++);
        return this
    }, nc.pop = function () {
        return this.length && delete this[this.length--], this.items.pop()
    }, nc.forEach = function (a, b) {
        for (var c = 0, d = this.items.length; d > c; c++)if (a.call(b, this.items[c], c) === !1)return this;
        return this
    };
    for (var oc in $b)$b[z](oc) && (nc[oc] = function (a) {
        return function () {
            var b = arguments;
            return this.forEach(function (c) {
                c[a][D](c, b)
            })
        }
    }(oc));
    return nc.attr = function (a, b) {
        if (a && c.is(a, V) && c.is(a[0], "object"))for (var d = 0, e = a.length; e > d; d++)this.items[d].attr(a[d]); else for (var f = 0, g = this.items.length; g > f; f++)this.items[f].attr(a, b);
        return this
    }, nc.clear = function () {
        for (; this.length;)this.pop()
    }, nc.splice = function (a, b) {
        a = 0 > a ? O(this.length + a, 0) : a, b = O(0, P(this.length - a, b));
        var c, d = [], e = [], f = [];
        for (c = 2; c < arguments.length; c++)f.push(arguments[c]);
        for (c = 0; b > c; c++)e.push(this[a + c]);
        for (; c < this.length - a; c++)d.push(this[a + c]);
        var g = f.length;
        for (c = 0; c < g + d.length; c++)this.items[a + c] = this[a + c] = g > c ? f[c] : d[c - g];
        for (c = this.items.length = this.length -= b - g; this[c];)delete this[c++];
        return new mc(e)
    }, nc.exclude = function (a) {
        for (var b = 0, c = this.length; c > b; b++)if (this[b] == a)return this.splice(b, 1), !0
    }, nc.animate = function (a, b, d, e) {
        (c.is(d, "function") || !d) && (e = d || null);
        var f, g, h = this.items.length, i = h, j = this;
        if (!h)return this;
        e && (g = function () {
            !--h && e.call(j)
        }), d = c.is(d, U) ? d : g;
        var k = c.animation(a, b, d, g);
        for (f = this.items[--i].animate(k); i--;)this.items[i] && !this.items[i].removed && this.items[i].animateWith(f, k, k), this.items[i] && !this.items[i].removed || h--;
        return this
    }, nc.insertAfter = function (a) {
        for (var b = this.items.length; b--;)this.items[b].insertAfter(a);
        return this
    }, nc.getBBox = function () {
        for (var a = [], b = [], c = [], d = [], e = this.items.length; e--;)if (!this.items[e].removed) {
            var f = this.items[e].getBBox();
            a.push(f.x), b.push(f.y), c.push(f.x + f.width), d.push(f.y + f.height)
        }
        return a = P[D](0, a), b = P[D](0, b), c = O[D](0, c), d = O[D](0, d), {
            x: a,
            y: b,
            x2: c,
            y2: d,
            width: c - a,
            height: d - b
        }
    }, nc.clone = function (a) {
        a = this.paper.set();
        for (var b = 0, c = this.items.length; c > b; b++)a.push(this.items[b].clone());
        return a
    }, nc.toString = function () {
        return "RaphaÃ«lâ€˜s set"
    }, nc.glow = function (a) {
        var b = this.paper.set();
        return this.forEach(function (c) {
            var d = c.glow(a);
            null != d && d.forEach(function (a) {
                b.push(a)
            })
        }), b
    }, nc.isPointInside = function (a, b) {
        var c = !1;
        return this.forEach(function (d) {
            return d.isPointInside(a, b) ? (console.log("runned"), c = !0, !1) : void 0
        }), c
    }, c.registerFont = function (a) {
        if (!a.face)return a;
        this.fonts = this.fonts || {};
        var b = {w: a.w, face: {}, glyphs: {}}, c = a.face["font-family"];
        for (var d in a.face)a.face[z](d) && (b.face[d] = a.face[d]);
        if (this.fonts[c] ? this.fonts[c].push(b) : this.fonts[c] = [b], !a.svg) {
            b.face["units-per-em"] = ab(a.face["units-per-em"], 10);
            for (var e in a.glyphs)if (a.glyphs[z](e)) {
                var f = a.glyphs[e];
                if (b.glyphs[e] = {
                        w: f.w, k: {}, d: f.d && "M" + f.d.replace(/[mlcxtrv]/g, function (a) {
                            return {l: "L", c: "C", x: "z", t: "m", r: "l", v: "c"}[a] || "M"
                        }) + "z"
                    }, f.k)for (var g in f.k)f[z](g) && (b.glyphs[e].k[g] = f.k[g])
            }
        }
        return a
    }, v.getFont = function (a, b, d, e) {
        if (e = e || "normal", d = d || "normal", b = +b || {
                normal: 400,
                bold: 700,
                lighter: 300,
                bolder: 800
            }[b] || 400, c.fonts) {
            var f = c.fonts[a];
            if (!f) {
                var g = new RegExp("(^|\\s)" + a.replace(/[^\w\d\s+!~.:_-]/g, G) + "(\\s|$)", "i");
                for (var h in c.fonts)if (c.fonts[z](h) && g.test(h)) {
                    f = c.fonts[h];
                    break
                }
            }
            var i;
            if (f)for (var j = 0, k = f.length; k > j && (i = f[j], i.face["font-weight"] != b || i.face["font-style"] != d && i.face["font-style"] || i.face["font-stretch"] != e); j++);
            return i
        }
    }, v.print = function (a, b, d, e, f, g, h, i) {
        g = g || "middle", h = O(P(h || 0, 1), -1), i = O(P(i || 1, 3), 1);
        var j, k = I(d)[J](G), l = 0, m = 0, n = G;
        if (c.is(e, "string") && (e = this.getFont(e)), e) {
            j = (f || 16) / e.face["units-per-em"];
            for (var o = e.face.bbox[J](w), p = +o[0], q = o[3] - o[1], r = 0, s = +o[1] + ("baseline" == g ? q + +e.face.descent : q / 2), t = 0, u = k.length; u > t; t++) {
                if ("\n" == k[t])l = 0, x = 0, m = 0, r += q * i; else {
                    var v = m && e.glyphs[k[t - 1]] || {}, x = e.glyphs[k[t]];
                    l += m ? (v.w || e.w) + (v.k && v.k[k[t]] || 0) + e.w * h : 0, m = 1
                }
                x && x.d && (n += c.transformPath(x.d, ["t", l * j, r * j, "s", j, j, p, s, "t", (a - p) / j, (b - s) / j]))
            }
        }
        return this.path(n).attr({fill: "#000", stroke: "none"})
    }, v.add = function (a) {
        if (c.is(a, "array"))for (var b, d = this.set(), e = 0, f = a.length; f > e; e++)b = a[e] || {}, x[z](b.type) && d.push(this[b.type]().attr(b));
        return d
    }, c.format = function (a, b) {
        var d = c.is(b, V) ? [0][E](b) : arguments;
        return a && c.is(a, U) && d.length - 1 && (a = a.replace(y, function (a, b) {
            return null == d[++b] ? G : d[b]
        })), a || G
    }, c.fullfill = function () {
        var a = /\{([^\}]+)\}/g, b = /(?:(?:^|\.)(.+?)(?=\[|\.|$|\()|\[('|")(.+?)\2\])(\(\))?/g, c = function (a, c, d) {
            var e = d;
            return c.replace(b, function (a, b, c, d, f) {
                b = b || d, e && (b in e && (e = e[b]), "function" == typeof e && f && (e = e()))
            }), e = (null == e || e == d ? a : e) + ""
        };
        return function (b, d) {
            return String(b).replace(a, function (a, b) {
                return c(a, b, d)
            })
        }
    }(), c.ninja = function () {
        return B.was ? A.win.Raphael = B.is : delete Raphael, c
    }, c.st = nc, function (a, b, d) {
        function e() {
            /in/.test(a.readyState) ? setTimeout(e, 9) : c.eve("raphael.DOMload")
        }

        null == a.readyState && a.addEventListener && (a.addEventListener(b, d = function () {
            a.removeEventListener(b, d, !1), a.readyState = "complete"
        }, !1), a.readyState = "loading"), e()
    }(document, "DOMContentLoaded"), b.on("raphael.DOMload", function () {
        u = !0
    }), function () {
        if (c.svg) {
            var a = "hasOwnProperty", b = String, d = parseFloat, e = parseInt, f = Math, g = f.max, h = f.abs, i = f.pow, j = /[, ]+/, k = c.eve, l = "", m = " ", n = "http://www.w3.org/1999/xlink", o = {
                block: "M5,0 0,2.5 5,5z",
                classic: "M5,0 0,2.5 5,5 3.5,3 3.5,2z",
                diamond: "M2.5,0 5,2.5 2.5,5 0,2.5z",
                open: "M6,1 1,3.5 6,6",
                oval: "M2.5,0A2.5,2.5,0,0,1,2.5,5 2.5,2.5,0,0,1,2.5,0z"
            }, p = {};
            c.toString = function () {
                return "Your browser supports SVG.\nYou are running RaphaÃ«l " + this.version
            };
            var q = function (d, e) {
                if (e) {
                    "string" == typeof d && (d = q(d));
                    for (var f in e)e[a](f) && ("xlink:" == f.substring(0, 6) ? d.setAttributeNS(n, f.substring(6), b(e[f])) : d.setAttribute(f, b(e[f])))
                } else d = c._g.doc.createElementNS("http://www.w3.org/2000/svg", d), d.style && (d.style.webkitTapHighlightColor = "rgba(0,0,0,0)");
                return d
            }, r = function (a, e) {
                var j = "linear", k = a.id + e, m = .5, n = .5, o = a.node, p = a.paper, r = o.style, s = c._g.doc.getElementById(k);
                if (!s) {
                    if (e = b(e).replace(c._radial_gradient, function (a, b, c) {
                            if (j = "radial", b && c) {
                                m = d(b), n = d(c);
                                var e = 2 * (n > .5) - 1;
                                i(m - .5, 2) + i(n - .5, 2) > .25 && (n = f.sqrt(.25 - i(m - .5, 2)) * e + .5) && .5 != n && (n = n.toFixed(5) - 1e-5 * e)
                            }
                            return l
                        }), e = e.split(/\s*\-\s*/), "linear" == j) {
                        var t = e.shift();
                        if (t = -d(t), isNaN(t))return null;
                        var u = [0, 0, f.cos(c.rad(t)), f.sin(c.rad(t))], v = 1 / (g(h(u[2]), h(u[3])) || 1);
                        u[2] *= v, u[3] *= v, u[2] < 0 && (u[0] = -u[2], u[2] = 0), u[3] < 0 && (u[1] = -u[3], u[3] = 0)
                    }
                    var w = c._parseDots(e);
                    if (!w)return null;
                    if (k = k.replace(/[\(\)\s,\xb0#]/g, "_"), a.gradient && k != a.gradient.id && (p.defs.removeChild(a.gradient), delete a.gradient), !a.gradient) {
                        s = q(j + "Gradient", {id: k}), a.gradient = s, q(s, "radial" == j ? {fx: m, fy: n} : {
                            x1: u[0],
                            y1: u[1],
                            x2: u[2],
                            y2: u[3],
                            gradientTransform: a.matrix.invert()
                        }), p.defs.appendChild(s);
                        for (var x = 0, y = w.length; y > x; x++)s.appendChild(q("stop", {
                            offset: w[x].offset ? w[x].offset : x ? "100%" : "0%",
                            "stop-color": w[x].color || "#fff"
                        }))
                    }
                }
                return q(o, {
                    fill: "url(#" + k + ")",
                    opacity: 1,
                    "fill-opacity": 1
                }), r.fill = l, r.opacity = 1, r.fillOpacity = 1, 1
            }, s = function (a) {
                var b = a.getBBox(1);
                q(a.pattern, {patternTransform: a.matrix.invert() + " translate(" + b.x + "," + b.y + ")"})
            }, t = function (d, e, f) {
                if ("path" == d.type) {
                    for (var g, h, i, j, k, m = b(e).toLowerCase().split("-"), n = d.paper, r = f ? "end" : "start", s = d.node, t = d.attrs, u = t["stroke-width"], v = m.length, w = "classic", x = 3, y = 3, z = 5; v--;)switch (m[v]) {
                        case"block":
                        case"classic":
                        case"oval":
                        case"diamond":
                        case"open":
                        case"none":
                            w = m[v];
                            break;
                        case"wide":
                            y = 5;
                            break;
                        case"narrow":
                            y = 2;
                            break;
                        case"long":
                            x = 5;
                            break;
                        case"short":
                            x = 2
                    }
                    if ("open" == w ? (x += 2, y += 2, z += 2, i = 1, j = f ? 4 : 1, k = {
                            fill: "none",
                            stroke: t.stroke
                        }) : (j = i = x / 2, k = {
                            fill: t.stroke,
                            stroke: "none"
                        }), d._.arrows ? f ? (d._.arrows.endPath && p[d._.arrows.endPath]--, d._.arrows.endMarker && p[d._.arrows.endMarker]--) : (d._.arrows.startPath && p[d._.arrows.startPath]--, d._.arrows.startMarker && p[d._.arrows.startMarker]--) : d._.arrows = {}, "none" != w) {
                        var A = "raphael-marker-" + w, B = "raphael-marker-" + r + w + x + y;
                        c._g.doc.getElementById(A) ? p[A]++ : (n.defs.appendChild(q(q("path"), {
                            "stroke-linecap": "round",
                            d: o[w],
                            id: A
                        })), p[A] = 1);
                        var C, D = c._g.doc.getElementById(B);
                        D ? (p[B]++, C = D.getElementsByTagName("use")[0]) : (D = q(q("marker"), {
                            id: B,
                            markerHeight: y,
                            markerWidth: x,
                            orient: "auto",
                            refX: j,
                            refY: y / 2
                        }), C = q(q("use"), {
                            "xlink:href": "#" + A,
                            transform: (f ? "rotate(180 " + x / 2 + " " + y / 2 + ") " : l) + "scale(" + x / z + "," + y / z + ")",
                            "stroke-width": (1 / ((x / z + y / z) / 2)).toFixed(4)
                        }), D.appendChild(C), n.defs.appendChild(D), p[B] = 1), q(C, k);
                        var E = i * ("diamond" != w && "oval" != w);
                        f ? (g = d._.arrows.startdx * u || 0, h = c.getTotalLength(t.path) - E * u) : (g = E * u, h = c.getTotalLength(t.path) - (d._.arrows.enddx * u || 0)), k = {}, k["marker-" + r] = "url(#" + B + ")", (h || g) && (k.d = c.getSubpath(t.path, g, h)), q(s, k), d._.arrows[r + "Path"] = A, d._.arrows[r + "Marker"] = B, d._.arrows[r + "dx"] = E, d._.arrows[r + "Type"] = w, d._.arrows[r + "String"] = e
                    } else f ? (g = d._.arrows.startdx * u || 0, h = c.getTotalLength(t.path) - g) : (g = 0, h = c.getTotalLength(t.path) - (d._.arrows.enddx * u || 0)), d._.arrows[r + "Path"] && q(s, {d: c.getSubpath(t.path, g, h)}), delete d._.arrows[r + "Path"], delete d._.arrows[r + "Marker"], delete d._.arrows[r + "dx"], delete d._.arrows[r + "Type"], delete d._.arrows[r + "String"];
                    for (k in p)if (p[a](k) && !p[k]) {
                        var F = c._g.doc.getElementById(k);
                        F && F.parentNode.removeChild(F)
                    }
                }
            }, u = {
                "": [0],
                none: [0],
                "-": [3, 1],
                ".": [1, 1],
                "-.": [3, 1, 1, 1],
                "-..": [3, 1, 1, 1, 1, 1],
                ". ": [1, 3],
                "- ": [4, 3],
                "--": [8, 3],
                "- .": [4, 3, 1, 3],
                "--.": [8, 3, 1, 3],
                "--..": [8, 3, 1, 3, 1, 3]
            }, v = function (a, c, d) {
                if (c = u[b(c).toLowerCase()]) {
                    for (var e = a.attrs["stroke-width"] || "1", f = {
                            round: e,
                            square: e,
                            butt: 0
                        }[a.attrs["stroke-linecap"] || d["stroke-linecap"]] || 0, g = [], h = c.length; h--;)g[h] = c[h] * e + (h % 2 ? 1 : -1) * f;
                    q(a.node, {"stroke-dasharray": g.join(",")})
                }
            }, w = function (d, f) {
                var i = d.node, k = d.attrs, m = i.style.visibility;
                i.style.visibility = "hidden";
                for (var o in f)if (f[a](o)) {
                    if (!c._availableAttrs[a](o))continue;
                    var p = f[o];
                    switch (k[o] = p, o) {
                        case"blur":
                            d.blur(p);
                            break;
                        case"href":
                        case"title":
                            var u = q("title"), w = c._g.doc.createTextNode(p);
                            u.appendChild(w), i.appendChild(u);
                            break;
                        case"target":
                            var x = i.parentNode;
                            if ("a" != x.tagName.toLowerCase()) {
                                var u = q("a");
                                x.insertBefore(u, i), u.appendChild(i), x = u
                            }
                            "target" == o ? x.setAttributeNS(n, "show", "blank" == p ? "new" : p) : x.setAttributeNS(n, o, p);
                            break;
                        case"cursor":
                            i.style.cursor = p;
                            break;
                        case"transform":
                            d.transform(p);
                            break;
                        case"arrow-start":
                            t(d, p);
                            break;
                        case"arrow-end":
                            t(d, p, 1);
                            break;
                        case"clip-rect":
                            var z = b(p).split(j);
                            if (4 == z.length) {
                                d.clip && d.clip.parentNode.parentNode.removeChild(d.clip.parentNode);
                                var A = q("clipPath"), B = q("rect");
                                A.id = c.createUUID(), q(B, {
                                    x: z[0],
                                    y: z[1],
                                    width: z[2],
                                    height: z[3]
                                }), A.appendChild(B), d.paper.defs.appendChild(A), q(i, {"clip-path": "url(#" + A.id + ")"}), d.clip = B
                            }
                            if (!p) {
                                var C = i.getAttribute("clip-path");
                                if (C) {
                                    var D = c._g.doc.getElementById(C.replace(/(^url\(#|\)$)/g, l));
                                    D && D.parentNode.removeChild(D), q(i, {"clip-path": l}), delete d.clip
                                }
                            }
                            break;
                        case"path":
                            "path" == d.type && (q(i, {d: p ? k.path = c._pathToAbsolute(p) : "M0,0"}), d._.dirty = 1, d._.arrows && ("startString"in d._.arrows && t(d, d._.arrows.startString), "endString"in d._.arrows && t(d, d._.arrows.endString, 1)));
                            break;
                        case"width":
                            if (i.setAttribute(o, p), d._.dirty = 1, !k.fx)break;
                            o = "x", p = k.x;
                        case"x":
                            k.fx && (p = -k.x - (k.width || 0));
                        case"rx":
                            if ("rx" == o && "rect" == d.type)break;
                        case"cx":
                            i.setAttribute(o, p), d.pattern && s(d), d._.dirty = 1;
                            break;
                        case"height":
                            if (i.setAttribute(o, p), d._.dirty = 1, !k.fy)break;
                            o = "y", p = k.y;
                        case"y":
                            k.fy && (p = -k.y - (k.height || 0));
                        case"ry":
                            if ("ry" == o && "rect" == d.type)break;
                        case"cy":
                            i.setAttribute(o, p), d.pattern && s(d), d._.dirty = 1;
                            break;
                        case"r":
                            "rect" == d.type ? q(i, {rx: p, ry: p}) : i.setAttribute(o, p), d._.dirty = 1;
                            break;
                        case"src":
                            "image" == d.type && i.setAttributeNS(n, "href", p);
                            break;
                        case"stroke-width":
                            (1 != d._.sx || 1 != d._.sy) && (p /= g(h(d._.sx), h(d._.sy)) || 1), d.paper._vbSize && (p *= d.paper._vbSize), i.setAttribute(o, p), k["stroke-dasharray"] && v(d, k["stroke-dasharray"], f), d._.arrows && ("startString"in d._.arrows && t(d, d._.arrows.startString), "endString"in d._.arrows && t(d, d._.arrows.endString, 1));
                            break;
                        case"stroke-dasharray":
                            v(d, p, f);
                            break;
                        case"fill":
                            var E = b(p).match(c._ISURL);
                            if (E) {
                                A = q("pattern");
                                var F = q("image");
                                A.id = c.createUUID(), q(A, {
                                    x: 0,
                                    y: 0,
                                    patternUnits: "userSpaceOnUse",
                                    height: 1,
                                    width: 1
                                }), q(F, {x: 0, y: 0, "xlink:href": E[1]}), A.appendChild(F), function (a) {
                                    c._preload(E[1], function () {
                                        var b = this.offsetWidth, c = this.offsetHeight;
                                        q(a, {width: b, height: c}), q(F, {width: b, height: c}), d.paper.safari()
                                    })
                                }(A), d.paper.defs.appendChild(A), q(i, {fill: "url(#" + A.id + ")"}), d.pattern = A, d.pattern && s(d);
                                break
                            }
                            var G = c.getRGB(p);
                            if (G.error) {
                                if (("circle" == d.type || "ellipse" == d.type || "r" != b(p).charAt()) && r(d, p)) {
                                    if ("opacity"in k || "fill-opacity"in k) {
                                        var H = c._g.doc.getElementById(i.getAttribute("fill").replace(/^url\(#|\)$/g, l));
                                        if (H) {
                                            var I = H.getElementsByTagName("stop");
                                            q(I[I.length - 1], {"stop-opacity": ("opacity"in k ? k.opacity : 1) * ("fill-opacity"in k ? k["fill-opacity"] : 1)})
                                        }
                                    }
                                    k.gradient = p, k.fill = "none";
                                    break
                                }
                            } else delete f.gradient, delete k.gradient, !c.is(k.opacity, "undefined") && c.is(f.opacity, "undefined") && q(i, {opacity: k.opacity}), !c.is(k["fill-opacity"], "undefined") && c.is(f["fill-opacity"], "undefined") && q(i, {"fill-opacity": k["fill-opacity"]});
                            G[a]("opacity") && q(i, {"fill-opacity": G.opacity > 1 ? G.opacity / 100 : G.opacity});
                        case"stroke":
                            G = c.getRGB(p), i.setAttribute(o, G.hex), "stroke" == o && G[a]("opacity") && q(i, {"stroke-opacity": G.opacity > 1 ? G.opacity / 100 : G.opacity}), "stroke" == o && d._.arrows && ("startString"in d._.arrows && t(d, d._.arrows.startString), "endString"in d._.arrows && t(d, d._.arrows.endString, 1));
                            break;
                        case"gradient":
                            ("circle" == d.type || "ellipse" == d.type || "r" != b(p).charAt()) && r(d, p);
                            break;
                        case"opacity":
                            k.gradient && !k[a]("stroke-opacity") && q(i, {"stroke-opacity": p > 1 ? p / 100 : p});
                        case"fill-opacity":
                            if (k.gradient) {
                                H = c._g.doc.getElementById(i.getAttribute("fill").replace(/^url\(#|\)$/g, l)), H && (I = H.getElementsByTagName("stop"), q(I[I.length - 1], {"stop-opacity": p}));
                                break
                            }
                        default:
                            "font-size" == o && (p = e(p, 10) + "px");
                            var J = o.replace(/(\-.)/g, function (a) {
                                return a.substring(1).toUpperCase()
                            });
                            i.style[J] = p, d._.dirty = 1, i.setAttribute(o, p)
                    }
                }
                y(d, f), i.style.visibility = m
            }, x = 1.2, y = function (d, f) {
                if ("text" == d.type && (f[a]("text") || f[a]("font") || f[a]("font-size") || f[a]("x") || f[a]("y"))) {
                    var g = d.attrs, h = d.node, i = h.firstChild ? e(c._g.doc.defaultView.getComputedStyle(h.firstChild, l).getPropertyValue("font-size"), 10) : 10;
                    if (f[a]("text")) {
                        for (g.text = f.text; h.firstChild;)h.removeChild(h.firstChild);
                        for (var j, k = b(f.text).split("\n"), m = [], n = 0, o = k.length; o > n; n++)j = q("tspan"), n && q(j, {
                            dy: i * x,
                            x: g.x
                        }), j.appendChild(c._g.doc.createTextNode(k[n])), h.appendChild(j), m[n] = j
                    } else for (m = h.getElementsByTagName("tspan"), n = 0, o = m.length; o > n; n++)n ? q(m[n], {
                        dy: i * x,
                        x: g.x
                    }) : q(m[0], {dy: 0});
                    q(h, {x: g.x, y: g.y}), d._.dirty = 1;
                    var p = d._getBBox(), r = g.y - (p.y + p.height / 2);
                    r && c.is(r, "finite") && q(m[0], {dy: r})
                }
            }, z = function (a, b) {
                this[0] = this.node = a, a.raphael = !0, this.id = c._oid++, a.raphaelid = this.id, this.matrix = c.matrix(), this.realPath = null, this.paper = b, this.attrs = this.attrs || {}, this._ = {
                    transform: [],
                    sx: 1,
                    sy: 1,
                    deg: 0,
                    dx: 0,
                    dy: 0,
                    dirty: 1
                }, !b.bottom && (b.bottom = this), this.prev = b.top, b.top && (b.top.next = this), b.top = this, this.next = null
            }, A = c.el;
            z.prototype = A, A.constructor = z, c._engine.path = function (a, b) {
                var c = q("path");
                b.canvas && b.canvas.appendChild(c);
                var d = new z(c, b);
                return d.type = "path", w(d, {fill: "none", stroke: "#000", path: a}), d
            }, A.rotate = function (a, c, e) {
                if (this.removed)return this;
                if (a = b(a).split(j), a.length - 1 && (c = d(a[1]), e = d(a[2])), a = d(a[0]), null == e && (c = e), null == c || null == e) {
                    var f = this.getBBox(1);
                    c = f.x + f.width / 2, e = f.y + f.height / 2
                }
                return this.transform(this._.transform.concat([["r", a, c, e]])), this
            }, A.scale = function (a, c, e, f) {
                if (this.removed)return this;
                if (a = b(a).split(j), a.length - 1 && (c = d(a[1]), e = d(a[2]), f = d(a[3])), a = d(a[0]), null == c && (c = a), null == f && (e = f), null == e || null == f)var g = this.getBBox(1);
                return e = null == e ? g.x + g.width / 2 : e, f = null == f ? g.y + g.height / 2 : f, this.transform(this._.transform.concat([["s", a, c, e, f]])), this
            }, A.translate = function (a, c) {
                return this.removed ? this : (a = b(a).split(j), a.length - 1 && (c = d(a[1])), a = d(a[0]) || 0, c = +c || 0, this.transform(this._.transform.concat([["t", a, c]])), this)
            }, A.transform = function (b) {
                var d = this._;
                if (null == b)return d.transform;
                if (c._extractTransform(this, b), this.clip && q(this.clip, {transform: this.matrix.invert()}), this.pattern && s(this), this.node && q(this.node, {transform: this.matrix}), 1 != d.sx || 1 != d.sy) {
                    var e = this.attrs[a]("stroke-width") ? this.attrs["stroke-width"] : 1;
                    this.attr({"stroke-width": e})
                }
                return this
            }, A.hide = function () {
                return !this.removed && this.paper.safari(this.node.style.display = "none"), this
            }, A.show = function () {
                return !this.removed && this.paper.safari(this.node.style.display = ""), this
            }, A.remove = function () {
                if (!this.removed && this.node.parentNode) {
                    var a = this.paper;
                    a.__set__ && a.__set__.exclude(this), k.unbind("raphael.*.*." + this.id), this.gradient && a.defs.removeChild(this.gradient), c._tear(this, a), "a" == this.node.parentNode.tagName.toLowerCase() ? this.node.parentNode.parentNode.removeChild(this.node.parentNode) : this.node.parentNode.removeChild(this.node);
                    for (var b in this)this[b] = "function" == typeof this[b] ? c._removedFactory(b) : null;
                    this.removed = !0
                }
            }, A._getBBox = function () {
                if ("none" == this.node.style.display) {
                    this.show();
                    var a = !0
                }
                var b = {};
                try {
                    b = this.node.getBBox()
                } catch (c) {
                } finally {
                    b = b || {}
                }
                return a && this.hide(), b
            }, A.attr = function (b, d) {
                if (this.removed)return this;
                if (null == b) {
                    var e = {};
                    for (var f in this.attrs)this.attrs[a](f) && (e[f] = this.attrs[f]);
                    return e.gradient && "none" == e.fill && (e.fill = e.gradient) && delete e.gradient, e.transform = this._.transform, e
                }
                if (null == d && c.is(b, "string")) {
                    if ("fill" == b && "none" == this.attrs.fill && this.attrs.gradient)return this.attrs.gradient;
                    if ("transform" == b)return this._.transform;
                    for (var g = b.split(j), h = {}, i = 0, l = g.length; l > i; i++)b = g[i], h[b] = b in this.attrs ? this.attrs[b] : c.is(this.paper.customAttributes[b], "function") ? this.paper.customAttributes[b].def : c._availableAttrs[b];
                    return l - 1 ? h : h[g[0]]
                }
                if (null == d && c.is(b, "array")) {
                    for (h = {}, i = 0, l = b.length; l > i; i++)h[b[i]] = this.attr(b[i]);
                    return h
                }
                if (null != d) {
                    var m = {};
                    m[b] = d
                } else null != b && c.is(b, "object") && (m = b);
                for (var n in m)k("raphael.attr." + n + "." + this.id, this, m[n]);
                for (n in this.paper.customAttributes)if (this.paper.customAttributes[a](n) && m[a](n) && c.is(this.paper.customAttributes[n], "function")) {
                    var o = this.paper.customAttributes[n].apply(this, [].concat(m[n]));
                    this.attrs[n] = m[n];
                    for (var p in o)o[a](p) && (m[p] = o[p])
                }
                return w(this, m), this
            }, A.toFront = function () {
                if (this.removed)return this;
                "a" == this.node.parentNode.tagName.toLowerCase() ? this.node.parentNode.parentNode.appendChild(this.node.parentNode) : this.node.parentNode.appendChild(this.node);
                var a = this.paper;
                return a.top != this && c._tofront(this, a), this
            }, A.toBack = function () {
                if (this.removed)return this;
                var a = this.node.parentNode;
                return "a" == a.tagName.toLowerCase() ? a.parentNode.insertBefore(this.node.parentNode, this.node.parentNode.parentNode.firstChild) : a.firstChild != this.node && a.insertBefore(this.node, this.node.parentNode.firstChild), c._toback(this, this.paper), this.paper, this
            }, A.insertAfter = function (a) {
                if (this.removed)return this;
                var b = a.node || a[a.length - 1].node;
                return b.nextSibling ? b.parentNode.insertBefore(this.node, b.nextSibling) : b.parentNode.appendChild(this.node), c._insertafter(this, a, this.paper), this
            }, A.insertBefore = function (a) {
                if (this.removed)return this;
                var b = a.node || a[0].node;
                return b.parentNode.insertBefore(this.node, b), c._insertbefore(this, a, this.paper), this
            }, A.blur = function (a) {
                var b = this;
                if (0 !== +a) {
                    var d = q("filter"), e = q("feGaussianBlur");
                    b.attrs.blur = a, d.id = c.createUUID(), q(e, {stdDeviation: +a || 1.5}), d.appendChild(e), b.paper.defs.appendChild(d), b._blur = d, q(b.node, {filter: "url(#" + d.id + ")"})
                } else b._blur && (b._blur.parentNode.removeChild(b._blur), delete b._blur, delete b.attrs.blur), b.node.removeAttribute("filter");
                return b
            }, c._engine.circle = function (a, b, c, d) {
                var e = q("circle");
                a.canvas && a.canvas.appendChild(e);
                var f = new z(e, a);
                return f.attrs = {cx: b, cy: c, r: d, fill: "none", stroke: "#000"}, f.type = "circle", q(e, f.attrs), f
            }, c._engine.rect = function (a, b, c, d, e, f) {
                var g = q("rect");
                a.canvas && a.canvas.appendChild(g);
                var h = new z(g, a);
                return h.attrs = {
                    x: b,
                    y: c,
                    width: d,
                    height: e,
                    r: f || 0,
                    rx: f || 0,
                    ry: f || 0,
                    fill: "none",
                    stroke: "#000"
                }, h.type = "rect", q(g, h.attrs), h
            }, c._engine.ellipse = function (a, b, c, d, e) {
                var f = q("ellipse");
                a.canvas && a.canvas.appendChild(f);
                var g = new z(f, a);
                return g.attrs = {
                    cx: b,
                    cy: c,
                    rx: d,
                    ry: e,
                    fill: "none",
                    stroke: "#000"
                }, g.type = "ellipse", q(f, g.attrs), g
            }, c._engine.image = function (a, b, c, d, e, f) {
                var g = q("image");
                q(g, {
                    x: c,
                    y: d,
                    width: e,
                    height: f,
                    preserveAspectRatio: "none"
                }), g.setAttributeNS(n, "href", b), a.canvas && a.canvas.appendChild(g);
                var h = new z(g, a);
                return h.attrs = {x: c, y: d, width: e, height: f, src: b}, h.type = "image", h
            }, c._engine.text = function (a, b, d, e) {
                var f = q("text");
                a.canvas && a.canvas.appendChild(f);
                var g = new z(f, a);
                return g.attrs = {
                    x: b,
                    y: d,
                    "text-anchor": "middle",
                    text: e,
                    font: c._availableAttrs.font,
                    stroke: "none",
                    fill: "#000"
                }, g.type = "text", w(g, g.attrs), g
            }, c._engine.setSize = function (a, b) {
                return this.width = a || this.width, this.height = b || this.height, this.canvas.setAttribute("width", this.width), this.canvas.setAttribute("height", this.height), this._viewBox && this.setViewBox.apply(this, this._viewBox), this
            }, c._engine.create = function () {
                var a = c._getContainer.apply(0, arguments), b = a && a.container, d = a.x, e = a.y, f = a.width, g = a.height;
                if (!b)throw new Error("SVG container not found.");
                var h, i = q("svg"), j = "overflow:hidden;";
                return d = d || 0, e = e || 0, f = f || 512, g = g || 342, q(i, {
                    height: g,
                    version: 1.1,
                    width: f,
                    xmlns: "http://www.w3.org/2000/svg"
                }), 1 == b ? (i.style.cssText = j + "position:absolute;left:" + d + "px;top:" + e + "px", c._g.doc.body.appendChild(i), h = 1) : (i.style.cssText = j + "position:relative", b.firstChild ? b.insertBefore(i, b.firstChild) : b.appendChild(i)), b = new c._Paper, b.width = f, b.height = g, b.canvas = i, b.clear(), b._left = b._top = 0, h && (b.renderfix = function () {
                }), b.renderfix(), b
            }, c._engine.setViewBox = function (a, b, c, d, e) {
                k("raphael.setViewBox", this, this._viewBox, [a, b, c, d, e]);
                var f, h, i = g(c / this.width, d / this.height), j = this.top, l = e ? "meet" : "xMinYMin";
                for (null == a ? (this._vbSize && (i = 1), delete this._vbSize, f = "0 0 " + this.width + m + this.height) : (this._vbSize = i, f = a + m + b + m + c + m + d), q(this.canvas, {
                    viewBox: f,
                    preserveAspectRatio: l
                }); i && j;)h = "stroke-width"in j.attrs ? j.attrs["stroke-width"] : 1, j.attr({"stroke-width": h}), j._.dirty = 1, j._.dirtyT = 1, j = j.prev;
                return this._viewBox = [a, b, c, d, !!e], this
            }, c.prototype.renderfix = function () {
                var a, b = this.canvas, c = b.style;
                try {
                    a = b.getScreenCTM() || b.createSVGMatrix()
                } catch (d) {
                    a = b.createSVGMatrix()
                }
                var e = -a.e % 1, f = -a.f % 1;
                (e || f) && (e && (this._left = (this._left + e) % 1, c.left = this._left + "px"), f && (this._top = (this._top + f) % 1, c.top = this._top + "px"))
            }, c.prototype.clear = function () {
                c.eve("raphael.clear", this);
                for (var a = this.canvas; a.firstChild;)a.removeChild(a.firstChild);
                this.bottom = this.top = null, (this.desc = q("desc")).appendChild(c._g.doc.createTextNode("Created with RaphaÃ«l " + c.version)), a.appendChild(this.desc), a.appendChild(this.defs = q("defs"))
            }, c.prototype.remove = function () {
                k("raphael.remove", this), this.canvas.parentNode && this.canvas.parentNode.removeChild(this.canvas);
                for (var a in this)this[a] = "function" == typeof this[a] ? c._removedFactory(a) : null
            };
            var B = c.st;
            for (var C in A)A[a](C) && !B[a](C) && (B[C] = function (a) {
                return function () {
                    var b = arguments;
                    return this.forEach(function (c) {
                        c[a].apply(c, b)
                    })
                }
            }(C))
        }
    }(), function () {
        if (c.vml) {
            var a = "hasOwnProperty", b = String, d = parseFloat, e = Math, f = e.round, g = e.max, h = e.min, i = e.abs, j = "fill", k = /[, ]+/, l = c.eve, m = " progid:DXImageTransform.Microsoft", n = " ", o = "", p = {
                M: "m",
                L: "l",
                C: "c",
                Z: "x",
                m: "t",
                l: "r",
                c: "v",
                z: "x"
            }, q = /([clmz]),?([^clmz]*)/gi, r = / progid:\S+Blur\([^\)]+\)/g, s = /-?[^,\s-]+/g, t = "position:absolute;left:0;top:0;width:1px;height:1px", u = 21600, v = {
                path: 1,
                rect: 1,
                image: 1
            }, w = {circle: 1, ellipse: 1}, x = function (a) {
                var d = /[ahqstv]/gi, e = c._pathToAbsolute;
                if (b(a).match(d) && (e = c._path2curve), d = /[clmz]/g, e == c._pathToAbsolute && !b(a).match(d)) {
                    var g = b(a).replace(q, function (a, b, c) {
                        var d = [], e = "m" == b.toLowerCase(), g = p[b];
                        return c.replace(s, function (a) {
                            e && 2 == d.length && (g += d + p["m" == b ? "l" : "L"], d = []), d.push(f(a * u))
                        }), g + d
                    });
                    return g
                }
                var h, i, j = e(a);
                g = [];
                for (var k = 0, l = j.length; l > k; k++) {
                    h = j[k], i = j[k][0].toLowerCase(), "z" == i && (i = "x");
                    for (var m = 1, r = h.length; r > m; m++)i += f(h[m] * u) + (m != r - 1 ? "," : o);
                    g.push(i)
                }
                return g.join(n)
            }, y = function (a, b, d) {
                var e = c.matrix();
                return e.rotate(-a, .5, .5), {dx: e.x(b, d), dy: e.y(b, d)}
            }, z = function (a, b, c, d, e, f) {
                var g = a._, h = a.matrix, k = g.fillpos, l = a.node, m = l.style, o = 1, p = "", q = u / b, r = u / c;
                if (m.visibility = "hidden", b && c) {
                    if (l.coordsize = i(q) + n + i(r), m.rotation = f * (0 > b * c ? -1 : 1), f) {
                        var s = y(f, d, e);
                        d = s.dx, e = s.dy
                    }
                    if (0 > b && (p += "x"), 0 > c && (p += " y") && (o = -1), m.flip = p, l.coordorigin = d * -q + n + e * -r, k || g.fillsize) {
                        var t = l.getElementsByTagName(j);
                        t = t && t[0], l.removeChild(t), k && (s = y(f, h.x(k[0], k[1]), h.y(k[0], k[1])), t.position = s.dx * o + n + s.dy * o), g.fillsize && (t.size = g.fillsize[0] * i(b) + n + g.fillsize[1] * i(c)), l.appendChild(t)
                    }
                    m.visibility = "visible"
                }
            };
            c.toString = function () {
                return "Your browser doesnâ€™t support SVG. Falling down to VML.\nYou are running RaphaÃ«l " + this.version
            };
            var A = function (a, c, d) {
                for (var e = b(c).toLowerCase().split("-"), f = d ? "end" : "start", g = e.length, h = "classic", i = "medium", j = "medium"; g--;)switch (e[g]) {
                    case"block":
                    case"classic":
                    case"oval":
                    case"diamond":
                    case"open":
                    case"none":
                        h = e[g];
                        break;
                    case"wide":
                    case"narrow":
                        j = e[g];
                        break;
                    case"long":
                    case"short":
                        i = e[g]
                }
                var k = a.node.getElementsByTagName("stroke")[0];
                k[f + "arrow"] = h, k[f + "arrowlength"] = i, k[f + "arrowwidth"] = j
            }, B = function (e, i) {
                e.attrs = e.attrs || {};
                var l = e.node, m = e.attrs, p = l.style, q = v[e.type] && (i.x != m.x || i.y != m.y || i.width != m.width || i.height != m.height || i.cx != m.cx || i.cy != m.cy || i.rx != m.rx || i.ry != m.ry || i.r != m.r), r = w[e.type] && (m.cx != i.cx || m.cy != i.cy || m.r != i.r || m.rx != i.rx || m.ry != i.ry), s = e;
                for (var t in i)i[a](t) && (m[t] = i[t]);
                if (q && (m.path = c._getPath[e.type](e), e._.dirty = 1), i.href && (l.href = i.href), i.title && (l.title = i.title), i.target && (l.target = i.target), i.cursor && (p.cursor = i.cursor), "blur"in i && e.blur(i.blur), (i.path && "path" == e.type || q) && (l.path = x(~b(m.path).toLowerCase().indexOf("r") ? c._pathToAbsolute(m.path) : m.path), "image" == e.type && (e._.fillpos = [m.x, m.y], e._.fillsize = [m.width, m.height], z(e, 1, 1, 0, 0, 0))), "transform"in i && e.transform(i.transform), r) {
                    var y = +m.cx, B = +m.cy, D = +m.rx || +m.r || 0, E = +m.ry || +m.r || 0;
                    l.path = c.format("ar{0},{1},{2},{3},{4},{1},{4},{1}x", f((y - D) * u), f((B - E) * u), f((y + D) * u), f((B + E) * u), f(y * u)), e._.dirty = 1
                }
                if ("clip-rect"in i) {
                    var G = b(i["clip-rect"]).split(k);
                    if (4 == G.length) {
                        G[2] = +G[2] + +G[0], G[3] = +G[3] + +G[1];
                        var H = l.clipRect || c._g.doc.createElement("div"), I = H.style;
                        I.clip = c.format("rect({1}px {2}px {3}px {0}px)", G), l.clipRect || (I.position = "absolute", I.top = 0, I.left = 0, I.width = e.paper.width + "px", I.height = e.paper.height + "px", l.parentNode.insertBefore(H, l), H.appendChild(l), l.clipRect = H)
                    }
                    i["clip-rect"] || l.clipRect && (l.clipRect.style.clip = "auto")
                }
                if (e.textpath) {
                    var J = e.textpath.style;
                    i.font && (J.font = i.font), i["font-family"] && (J.fontFamily = '"' + i["font-family"].split(",")[0].replace(/^['"]+|['"]+$/g, o) + '"'), i["font-size"] && (J.fontSize = i["font-size"]), i["font-weight"] && (J.fontWeight = i["font-weight"]), i["font-style"] && (J.fontStyle = i["font-style"])
                }
                if ("arrow-start"in i && A(s, i["arrow-start"]), "arrow-end"in i && A(s, i["arrow-end"], 1), null != i.opacity || null != i["stroke-width"] || null != i.fill || null != i.src || null != i.stroke || null != i["stroke-width"] || null != i["stroke-opacity"] || null != i["fill-opacity"] || null != i["stroke-dasharray"] || null != i["stroke-miterlimit"] || null != i["stroke-linejoin"] || null != i["stroke-linecap"]) {
                    var K = l.getElementsByTagName(j), L = !1;
                    if (K = K && K[0], !K && (L = K = F(j)), "image" == e.type && i.src && (K.src = i.src), i.fill && (K.on = !0), (null == K.on || "none" == i.fill || null === i.fill) && (K.on = !1), K.on && i.fill) {
                        var M = b(i.fill).match(c._ISURL);
                        if (M) {
                            K.parentNode == l && l.removeChild(K), K.rotate = !0, K.src = M[1], K.type = "tile";
                            var N = e.getBBox(1);
                            K.position = N.x + n + N.y, e._.fillpos = [N.x, N.y], c._preload(M[1], function () {
                                e._.fillsize = [this.offsetWidth, this.offsetHeight]
                            })
                        } else K.color = c.getRGB(i.fill).hex, K.src = o, K.type = "solid", c.getRGB(i.fill).error && (s.type in{
                            circle: 1,
                            ellipse: 1
                        } || "r" != b(i.fill).charAt()) && C(s, i.fill, K) && (m.fill = "none", m.gradient = i.fill, K.rotate = !1)
                    }
                    if ("fill-opacity"in i || "opacity"in i) {
                        var O = ((+m["fill-opacity"] + 1 || 2) - 1) * ((+m.opacity + 1 || 2) - 1) * ((+c.getRGB(i.fill).o + 1 || 2) - 1);
                        O = h(g(O, 0), 1), K.opacity = O, K.src && (K.color = "none")
                    }
                    l.appendChild(K);
                    var P = l.getElementsByTagName("stroke") && l.getElementsByTagName("stroke")[0], Q = !1;
                    !P && (Q = P = F("stroke")), (i.stroke && "none" != i.stroke || i["stroke-width"] || null != i["stroke-opacity"] || i["stroke-dasharray"] || i["stroke-miterlimit"] || i["stroke-linejoin"] || i["stroke-linecap"]) && (P.on = !0), ("none" == i.stroke || null === i.stroke || null == P.on || 0 == i.stroke || 0 == i["stroke-width"]) && (P.on = !1);
                    var R = c.getRGB(i.stroke);
                    P.on && i.stroke && (P.color = R.hex), O = ((+m["stroke-opacity"] + 1 || 2) - 1) * ((+m.opacity + 1 || 2) - 1) * ((+R.o + 1 || 2) - 1);
                    var S = .75 * (d(i["stroke-width"]) || 1);
                    if (O = h(g(O, 0), 1), null == i["stroke-width"] && (S = m["stroke-width"]), i["stroke-width"] && (P.weight = S), S && 1 > S && (O *= S) && (P.weight = 1), P.opacity = O, i["stroke-linejoin"] && (P.joinstyle = i["stroke-linejoin"] || "miter"), P.miterlimit = i["stroke-miterlimit"] || 8, i["stroke-linecap"] && (P.endcap = "butt" == i["stroke-linecap"] ? "flat" : "square" == i["stroke-linecap"] ? "square" : "round"), i["stroke-dasharray"]) {
                        var T = {
                            "-": "shortdash",
                            ".": "shortdot",
                            "-.": "shortdashdot",
                            "-..": "shortdashdotdot",
                            ". ": "dot",
                            "- ": "dash",
                            "--": "longdash",
                            "- .": "dashdot",
                            "--.": "longdashdot",
                            "--..": "longdashdotdot"
                        };
                        P.dashstyle = T[a](i["stroke-dasharray"]) ? T[i["stroke-dasharray"]] : o
                    }
                    Q && l.appendChild(P)
                }
                if ("text" == s.type) {
                    s.paper.canvas.style.display = o;
                    var U = s.paper.span, V = 100, W = m.font && m.font.match(/\d+(?:\.\d*)?(?=px)/);
                    p = U.style, m.font && (p.font = m.font), m["font-family"] && (p.fontFamily = m["font-family"]), m["font-weight"] && (p.fontWeight = m["font-weight"]), m["font-style"] && (p.fontStyle = m["font-style"]), W = d(m["font-size"] || W && W[0]) || 10, p.fontSize = W * V + "px", s.textpath.string && (U.innerHTML = b(s.textpath.string).replace(/</g, "&#60;").replace(/&/g, "&#38;").replace(/\n/g, "<br>"));
                    var X = U.getBoundingClientRect();
                    s.W = m.w = (X.right - X.left) / V, s.H = m.h = (X.bottom - X.top) / V, s.X = m.x, s.Y = m.y + s.H / 2, ("x"in i || "y"in i) && (s.path.v = c.format("m{0},{1}l{2},{1}", f(m.x * u), f(m.y * u), f(m.x * u) + 1));
                    for (var Y = ["x", "y", "text", "font", "font-family", "font-weight", "font-style", "font-size"], Z = 0, $ = Y.length; $ > Z; Z++)if (Y[Z]in i) {
                        s._.dirty = 1;
                        break
                    }
                    switch (m["text-anchor"]) {
                        case"start":
                            s.textpath.style["v-text-align"] = "left", s.bbx = s.W / 2;
                            break;
                        case"end":
                            s.textpath.style["v-text-align"] = "right", s.bbx = -s.W / 2;
                            break;
                        default:
                            s.textpath.style["v-text-align"] = "center", s.bbx = 0
                    }
                    s.textpath.style["v-text-kern"] = !0
                }
            }, C = function (a, f, g) {
                a.attrs = a.attrs || {};
                var h = (a.attrs, Math.pow), i = "linear", j = ".5 .5";
                if (a.attrs.gradient = f, f = b(f).replace(c._radial_gradient, function (a, b, c) {
                        return i = "radial", b && c && (b = d(b), c = d(c), h(b - .5, 2) + h(c - .5, 2) > .25 && (c = e.sqrt(.25 - h(b - .5, 2)) * (2 * (c > .5) - 1) + .5), j = b + n + c), o
                    }), f = f.split(/\s*\-\s*/), "linear" == i) {
                    var k = f.shift();
                    if (k = -d(k), isNaN(k))return null
                }
                var l = c._parseDots(f);
                if (!l)return null;
                if (a = a.shape || a.node, l.length) {
                    a.removeChild(g), g.on = !0, g.method = "none", g.color = l[0].color, g.color2 = l[l.length - 1].color;
                    for (var m = [], p = 0, q = l.length; q > p; p++)l[p].offset && m.push(l[p].offset + n + l[p].color);
                    g.colors = m.length ? m.join() : "0% " + g.color, "radial" == i ? (g.type = "gradientTitle", g.focus = "100%", g.focussize = "0 0", g.focusposition = j, g.angle = 0) : (g.type = "gradient", g.angle = (270 - k) % 360), a.appendChild(g)
                }
                return 1
            }, D = function (a, b) {
                this[0] = this.node = a, a.raphael = !0, this.id = c._oid++, a.raphaelid = this.id, this.X = 0, this.Y = 0, this.attrs = {}, this.paper = b, this.matrix = c.matrix(), this._ = {
                    transform: [],
                    sx: 1,
                    sy: 1,
                    dx: 0,
                    dy: 0,
                    deg: 0,
                    dirty: 1,
                    dirtyT: 1
                }, !b.bottom && (b.bottom = this), this.prev = b.top, b.top && (b.top.next = this), b.top = this, this.next = null
            }, E = c.el;
            D.prototype = E, E.constructor = D, E.transform = function (a) {
                if (null == a)return this._.transform;
                var d, e = this.paper._viewBoxShift, f = e ? "s" + [e.scale, e.scale] + "-1-1t" + [e.dx, e.dy] : o;
                e && (d = a = b(a).replace(/\.{3}|\u2026/g, this._.transform || o)), c._extractTransform(this, f + a);
                var g, h = this.matrix.clone(), i = this.skew, j = this.node, k = ~b(this.attrs.fill).indexOf("-"), l = !b(this.attrs.fill).indexOf("url(");
                if (h.translate(1, 1), l || k || "image" == this.type)if (i.matrix = "1 0 0 1", i.offset = "0 0", g = h.split(), k && g.noRotation || !g.isSimple) {
                    j.style.filter = h.toFilter();
                    var m = this.getBBox(), p = this.getBBox(1), q = m.x - p.x, r = m.y - p.y;
                    j.coordorigin = q * -u + n + r * -u, z(this, 1, 1, q, r, 0)
                } else j.style.filter = o, z(this, g.scalex, g.scaley, g.dx, g.dy, g.rotate); else j.style.filter = o, i.matrix = b(h), i.offset = h.offset();
                return d && (this._.transform = d), this
            }, E.rotate = function (a, c, e) {
                if (this.removed)return this;
                if (null != a) {
                    if (a = b(a).split(k), a.length - 1 && (c = d(a[1]), e = d(a[2])), a = d(a[0]), null == e && (c = e), null == c || null == e) {
                        var f = this.getBBox(1);
                        c = f.x + f.width / 2, e = f.y + f.height / 2
                    }
                    return this._.dirtyT = 1, this.transform(this._.transform.concat([["r", a, c, e]])), this
                }
            }, E.translate = function (a, c) {
                return this.removed ? this : (a = b(a).split(k), a.length - 1 && (c = d(a[1])), a = d(a[0]) || 0, c = +c || 0, this._.bbox && (this._.bbox.x += a, this._.bbox.y += c), this.transform(this._.transform.concat([["t", a, c]])), this)
            }, E.scale = function (a, c, e, f) {
                if (this.removed)return this;
                if (a = b(a).split(k), a.length - 1 && (c = d(a[1]), e = d(a[2]), f = d(a[3]), isNaN(e) && (e = null), isNaN(f) && (f = null)), a = d(a[0]), null == c && (c = a), null == f && (e = f), null == e || null == f)var g = this.getBBox(1);
                return e = null == e ? g.x + g.width / 2 : e, f = null == f ? g.y + g.height / 2 : f, this.transform(this._.transform.concat([["s", a, c, e, f]])), this._.dirtyT = 1, this
            }, E.hide = function () {
                return !this.removed && (this.node.style.display = "none"), this
            }, E.show = function () {
                return !this.removed && (this.node.style.display = o), this
            }, E._getBBox = function () {
                return this.removed ? {} : {
                    x: this.X + (this.bbx || 0) - this.W / 2,
                    y: this.Y - this.H,
                    width: this.W,
                    height: this.H
                }
            }, E.remove = function () {
                if (!this.removed && this.node.parentNode) {
                    this.paper.__set__ && this.paper.__set__.exclude(this), c.eve.unbind("raphael.*.*." + this.id), c._tear(this, this.paper), this.node.parentNode.removeChild(this.node), this.shape && this.shape.parentNode.removeChild(this.shape);
                    for (var a in this)this[a] = "function" == typeof this[a] ? c._removedFactory(a) : null;
                    this.removed = !0
                }
            }, E.attr = function (b, d) {
                if (this.removed)return this;
                if (null == b) {
                    var e = {};
                    for (var f in this.attrs)this.attrs[a](f) && (e[f] = this.attrs[f]);
                    return e.gradient && "none" == e.fill && (e.fill = e.gradient) && delete e.gradient, e.transform = this._.transform, e
                }
                if (null == d && c.is(b, "string")) {
                    if (b == j && "none" == this.attrs.fill && this.attrs.gradient)return this.attrs.gradient;
                    for (var g = b.split(k), h = {}, i = 0, m = g.length; m > i; i++)b = g[i], h[b] = b in this.attrs ? this.attrs[b] : c.is(this.paper.customAttributes[b], "function") ? this.paper.customAttributes[b].def : c._availableAttrs[b];
                    return m - 1 ? h : h[g[0]]
                }
                if (this.attrs && null == d && c.is(b, "array")) {
                    for (h = {}, i = 0, m = b.length; m > i; i++)h[b[i]] = this.attr(b[i]);
                    return h
                }
                var n;
                null != d && (n = {}, n[b] = d), null == d && c.is(b, "object") && (n = b);
                for (var o in n)l("raphael.attr." + o + "." + this.id, this, n[o]);
                if (n) {
                    for (o in this.paper.customAttributes)if (this.paper.customAttributes[a](o) && n[a](o) && c.is(this.paper.customAttributes[o], "function")) {
                        var p = this.paper.customAttributes[o].apply(this, [].concat(n[o]));
                        this.attrs[o] = n[o];
                        for (var q in p)p[a](q) && (n[q] = p[q])
                    }
                    n.text && "text" == this.type && (this.textpath.string = n.text), B(this, n)
                }
                return this
            }, E.toFront = function () {
                return !this.removed && this.node.parentNode.appendChild(this.node), this.paper && this.paper.top != this && c._tofront(this, this.paper), this
            }, E.toBack = function () {
                return this.removed ? this : (this.node.parentNode.firstChild != this.node && (this.node.parentNode.insertBefore(this.node, this.node.parentNode.firstChild), c._toback(this, this.paper)), this)
            }, E.insertAfter = function (a) {
                return this.removed ? this : (a.constructor == c.st.constructor && (a = a[a.length - 1]), a.node.nextSibling ? a.node.parentNode.insertBefore(this.node, a.node.nextSibling) : a.node.parentNode.appendChild(this.node), c._insertafter(this, a, this.paper), this)
            }, E.insertBefore = function (a) {
                return this.removed ? this : (a.constructor == c.st.constructor && (a = a[0]), a.node.parentNode.insertBefore(this.node, a.node), c._insertbefore(this, a, this.paper), this)
            }, E.blur = function (a) {
                var b = this.node.runtimeStyle, d = b.filter;
                return d = d.replace(r, o), 0 !== +a ? (this.attrs.blur = a, b.filter = d + n + m + ".Blur(pixelradius=" + (+a || 1.5) + ")", b.margin = c.format("-{0}px 0 0 -{0}px", f(+a || 1.5))) : (b.filter = d, b.margin = 0, delete this.attrs.blur), this
            }, c._engine.path = function (a, b) {
                var c = F("shape");
                c.style.cssText = t, c.coordsize = u + n + u, c.coordorigin = b.coordorigin;
                var d = new D(c, b), e = {fill: "none", stroke: "#000"};
                a && (e.path = a), d.type = "path", d.path = [], d.Path = o, B(d, e), b.canvas.appendChild(c);
                var f = F("skew");
                return f.on = !0, c.appendChild(f), d.skew = f, d.transform(o), d
            }, c._engine.rect = function (a, b, d, e, f, g) {
                var h = c._rectPath(b, d, e, f, g), i = a.path(h), j = i.attrs;
                return i.X = j.x = b, i.Y = j.y = d, i.W = j.width = e, i.H = j.height = f, j.r = g, j.path = h, i.type = "rect", i
            }, c._engine.ellipse = function (a, b, c, d, e) {
                var f = a.path();
                return f.attrs, f.X = b - d, f.Y = c - e, f.W = 2 * d, f.H = 2 * e, f.type = "ellipse", B(f, {
                    cx: b,
                    cy: c,
                    rx: d,
                    ry: e
                }), f
            }, c._engine.circle = function (a, b, c, d) {
                var e = a.path();
                return e.attrs, e.X = b - d, e.Y = c - d, e.W = e.H = 2 * d, e.type = "circle", B(e, {
                    cx: b,
                    cy: c,
                    r: d
                }), e
            }, c._engine.image = function (a, b, d, e, f, g) {
                var h = c._rectPath(d, e, f, g), i = a.path(h).attr({stroke: "none"}), k = i.attrs, l = i.node, m = l.getElementsByTagName(j)[0];
                return k.src = b, i.X = k.x = d, i.Y = k.y = e, i.W = k.width = f, i.H = k.height = g, k.path = h, i.type = "image", m.parentNode == l && l.removeChild(m), m.rotate = !0, m.src = b, m.type = "tile", i._.fillpos = [d, e], i._.fillsize = [f, g], l.appendChild(m), z(i, 1, 1, 0, 0, 0), i
            }, c._engine.text = function (a, d, e, g) {
                var h = F("shape"), i = F("path"), j = F("textpath");
                d = d || 0, e = e || 0, g = g || "", i.v = c.format("m{0},{1}l{2},{1}", f(d * u), f(e * u), f(d * u) + 1), i.textpathok = !0, j.string = b(g), j.on = !0, h.style.cssText = t, h.coordsize = u + n + u, h.coordorigin = "0 0";
                var k = new D(h, a), l = {fill: "#000", stroke: "none", font: c._availableAttrs.font, text: g};
                k.shape = h, k.path = i, k.textpath = j, k.type = "text", k.attrs.text = b(g), k.attrs.x = d, k.attrs.y = e, k.attrs.w = 1, k.attrs.h = 1, B(k, l), h.appendChild(j), h.appendChild(i), a.canvas.appendChild(h);
                var m = F("skew");
                return m.on = !0, h.appendChild(m), k.skew = m, k.transform(o), k
            }, c._engine.setSize = function (a, b) {
                var d = this.canvas.style;
                return this.width = a, this.height = b, a == +a && (a += "px"), b == +b && (b += "px"), d.width = a, d.height = b, d.clip = "rect(0 " + a + " " + b + " 0)", this._viewBox && c._engine.setViewBox.apply(this, this._viewBox), this
            }, c._engine.setViewBox = function (a, b, d, e, f) {
                c.eve("raphael.setViewBox", this, this._viewBox, [a, b, d, e, f]);
                var h, i, j = this.width, k = this.height, l = 1 / g(d / j, e / k);
                return f && (h = k / e, i = j / d, j > d * h && (a -= (j - d * h) / 2 / h), k > e * i && (b -= (k - e * i) / 2 / i)), this._viewBox = [a, b, d, e, !!f], this._viewBoxShift = {
                    dx: -a,
                    dy: -b,
                    scale: l
                }, this.forEach(function (a) {
                    a.transform("...")
                }), this
            };
            var F;
            c._engine.initWin = function (a) {
                var b = a.document;
                b.createStyleSheet().addRule(".rvml", "behavior:url(#default#VML)");
                try {
                    !b.namespaces.rvml && b.namespaces.add("rvml", "urn:schemas-microsoft-com:vml"), F = function (a) {
                        return b.createElement("<rvml:" + a + ' class="rvml">')
                    }
                } catch (c) {
                    F = function (a) {
                        return b.createElement("<" + a + ' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')
                    }
                }
            }, c._engine.initWin(c._g.win), c._engine.create = function () {
                var a = c._getContainer.apply(0, arguments), b = a.container, d = a.height, e = a.width, f = a.x, g = a.y;
                if (!b)throw new Error("VML container not found.");
                var h = new c._Paper, i = h.canvas = c._g.doc.createElement("div"), j = i.style;
                return f = f || 0, g = g || 0, e = e || 512, d = d || 342, h.width = e, h.height = d, e == +e && (e += "px"), d == +d && (d += "px"), h.coordsize = 1e3 * u + n + 1e3 * u, h.coordorigin = "0 0", h.span = c._g.doc.createElement("span"), h.span.style.cssText = "position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;", i.appendChild(h.span), j.cssText = c.format("top:0;left:0;width:{0};height:{1};display:inline-block;position:relative;clip:rect(0 {0} {1} 0);overflow:hidden", e, d), 1 == b ? (c._g.doc.body.appendChild(i), j.left = f + "px", j.top = g + "px", j.position = "absolute") : b.firstChild ? b.insertBefore(i, b.firstChild) : b.appendChild(i), h.renderfix = function () {
                }, h
            }, c.prototype.clear = function () {
                c.eve("raphael.clear", this), this.canvas.innerHTML = o, this.span = c._g.doc.createElement("span"), this.span.style.cssText = "position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;display:inline;", this.canvas.appendChild(this.span), this.bottom = this.top = null
            }, c.prototype.remove = function () {
                c.eve("raphael.remove", this), this.canvas.parentNode.removeChild(this.canvas);
                for (var a in this)this[a] = "function" == typeof this[a] ? c._removedFactory(a) : null;
                return !0
            };
            var G = c.st;
            for (var H in E)E[a](H) && !G[a](H) && (G[H] = function (a) {
                return function () {
                    var b = arguments;
                    return this.forEach(function (c) {
                        c[a].apply(c, b)
                    })
                }
            }(H))
        }
    }(), B.was ? A.win.Raphael = c : Raphael = c, c
});