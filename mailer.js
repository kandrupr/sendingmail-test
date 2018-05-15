var http = require('http');
var mailer = require('nodemailer');
var auth = require('./GmailAuth.js');

const transporter = mailer.createTransport({
    service: 'gmail',
    auth: auth
});

var mailOptions = {
    from: 'kandrupr.github@gmail.com',
    to: 'pk.kandru@gmail.com',
    subject: 'Node Mail',
    text: 'Send an email using node'
};

var server = http.createServer(function(req, res) {
    res.writeHead(200);
    transporter.sendMail(mailOptions, function(error, info) {
        if (error) {
            res.end("FAILED");
        } else {
            res.end('Email sent: ' + info.response);
        }
    });
});

server.listen(8000);