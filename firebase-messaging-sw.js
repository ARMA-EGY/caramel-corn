//  var firebaseConfig = {
//    apiKey: "AIzaSyCLk14OprGVUh7sCZ_TdLafNbNvI32c7w0",
//    authDomain: "nohahimmat-project.firebaseapp.com",
//    databaseURL: "https://nohahimmat-project.firebaseio.com",
//    projectId: "nohahimmat-project",
//    storageBucket: "nohahimmat-project.appspot.com",
//    messagingSenderId: "301487091142",
//    appId: "1:301487091142:web:c21a07b715f82279bd96c7",
//    measurementId: "G-Y8CSR0ELRM"
//  };
//  // Initialize Firebase
//  firebase.initializeApp(firebaseConfig);
//  firebase.analytics();
//	
//  // Retrieve Firebase Messaging object.
//const messaging = firebase.messaging();
//
//messaging.setBackgroundMessageHandler(function(payload) {
// console.log('[firebase-messaging-sw.js] Received background message ', payload);
// const notificationTitle = payload.data.title;
//  const notificationOptions = {
//   body: payload.data.body,
//   icon: payload.data.body,
//   icon: 'payload.data.body };
//
//  return self.registration.showNotification(notificationTitle,
//     notificationOptions);
//});
	
	
	
	
	// Import and configure the Firebase SDK
// These scripts are made available when the app is served or deployed on Firebase Hosting
// If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup
importScripts('https://www.gstatic.com/firebasejs/7.8.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.8.2/firebase-messaging.js');

// TODO: Replace the following with your app's Firebase project configuration

  const firebaseConfig = {
    apiKey: "AIzaSyAf-iU56NqohoFxIFtwYWiX1Ix7FKfFdW8",
    authDomain: "caramel-corn.firebaseapp.com",
    databaseURL: "https://caramel-corn.firebaseio.com",
    projectId: "caramel-corn",
    storageBucket: "caramel-corn.appspot.com",
    messagingSenderId: "652581811330",
    appId: "1:652581811330:web:3cd814bc941c9a5299b09b",
    measurementId: "G-YC236VJYC6"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);


const messaging = firebase.messaging();

/**
 * Here is is the code snippet to initialize Firebase Messaging in the Service
 * Worker when your app is not hosted on Firebase Hosting.

 // [START initialize_firebase_in_sw]
 // Give the service worker access to Firebase Messaging.
 // Note that you can only use Firebase Messaging here, other Firebase libraries
 // are not available in the service worker.
 importScripts('https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js');
 importScripts('https://www.gstatic.com/firebasejs/7.6.0/firebase-messaging.js');

 // Initialize the Firebase app in the service worker by passing in the
 // messagingSenderId.
 firebase.initializeApp({
   'messagingSenderId': 'YOUR-SENDER-ID'
 });

 // Retrieve an instance of Firebase Messaging so that it can handle background
 // messages.
 const messaging = firebase.messaging();
 // [END initialize_firebase_in_sw]
 **/


// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]
messaging.setBackgroundMessageHandler(function(payload) {
    // console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    notificationTitle = payload.data.title;
    notificationOptions = {
        body : payload.data.body,
        image: payload.data.image,
        icon : payload.data.icon,
        data:{
            time: new Date(Date.now()).toString(),
            click_action: payload.data.click_action
        }
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});
// [END background_handler]

self.addEventListener('notificationclick', function(event) 
{
   
   var action_click = event.notification.data.click_action;
   event.notification.close();
   
   event.waitUntail(clients.openWindow(action_click));
    
});







