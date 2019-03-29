Ext.onReady(function(){
  var addNewWebsiteWindow = function() {
    var addNewWebsite = function () {
      return;  
    };
    
    var alias = new Ext.form.TextField({
      fieldLabel: 'Name',
      name: 'alias',
      width: 100
    });
    
    var url = new Ext.form.TextField({
      fieldLabel: 'URL',
      name: 'url',
      width: 200
    });
    
    var form = new Ext.form.FormPanel({
      labelAlign: 'top',
      padding: 5,
      items: [alias, url],
      buttons: [{
        text: 'Add',
        handler: addNewWebsite
        }]
    });    
    var w = new Ext.Window({
      title: 'Add New Website',
      width: 300,
      items: [form]
    });
    
    w.show();
  };
  
	var goHome = function() {
		var homePage = "index.html";
		window.location = homePage;
			/*Ext.Ajax.request({
							 url: 'index-lilypai_zxq.php',
							 headers: { 'Content-Type': 'application/json'},
							 params: { newPage: 'homePage' },
							 success: function() {
							 window.location.reload();
							 },
							 failure: function() {
							 alert("Problems reloading!");
							 }
							 });*/
	};
	var openResume = function() {
    /*var wrd=new ActiveXObject("Word.Application");
   wrd.visible=true;
   wrd.Application.Activate();
   wrd.Documents.Open("AddressLabel.docx");
   wrd=null;*/
  window.open('http://lilypai.byethost31.com/Resume October 2015.pdf', "_blank");
	};
	var openPurchaseManager = function() {
		window.open('http://mypurchasemanager.zxq.net','My Purchase Manager','width=400,height=200');
	};
	var openGuestBook = function() {
		var newPage = "guestbook.php";
		window.location = newPage;
		/*Ext.Ajax.request({
							 url: 'index-lilypai_zxq.php',
							 headers: { 'Content-Type': 'application/json'},
							 jsonData: { newPage: 'guestBook' },
							 success: function() {
								window.location.reload();
							},
							 failure: function() {
								alert("Problems reloading!");
							 }
							 });
 
 */
	};
			
  var wMenu = new Ext.menu.Menu({
    items: [{
      text: 'Add New Website',
      handler: addNewWebsiteWindow
    }]
  });  
  var toolbar = new Ext.Toolbar({
    renderTo: 'mainToolBar',
    height: 40,
	items: [{
		text: 'Home',
		handler: goHome,
		width: 200			
	}, {
		text: 'Websites',
		menu: wMenu,
		width: 200
    }, {
		text: 'Resume',
		handler: openResume,
		width: 200
    }, {
		text: 'Purchase Manager',
		handler: openPurchaseManager,
		width: 200
	}, {
		text: 'Guest Book',
		handler: openGuestBook,
		width: 200
	}]
  });
});