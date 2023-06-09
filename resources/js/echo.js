Echo
    .channel('feedback.created')
    .listen('FeedbackCreated', (data) => {
        notyf.success('New feedback created');
        console.log(data);
    })
