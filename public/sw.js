self.addEventListener('push', function(e) {
    const data = e.data ? e.data.json() : {};
    const title = data.title || 'ServiceMate';
    const options = {
        body: data.body || 'Ada reminder baru!',
        icon: '/icon-192.png',
        badge: '/icon-192.png',
        data: { url: data.url || '/reminders' }
    };
    e.waitUntil(self.registration.showNotification(title, options));
});
 
self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    e.waitUntil(clients.openWindow(e.notification.data.url));
});
 
