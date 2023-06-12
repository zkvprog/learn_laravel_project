Echo
    .channel('feedback.created')
    .listen('FeedbackCreated', (data) => {
        const notification = notyf.success('New feedback created');
        notification.on('click', ({target, event}) => {
            window.location.href = '/admin/feedback/' + data.feedback.id;
        });
    })
