function calculateRate(weight, mail_tpye) {
    switch (mail_tpye) {
        case "flat":
            return (Math.floor(weight) * .15) + 1.00;
        case "stamped":
            if (weight > 3) { weight = 4 }
            return (Math.floor(weight) * .15) + 0.55;
        case "metered":
            if (weight > 3) { weight = 4 }
            return (Math.floor(weight) * .15) + 0.50;
        default:
            if (weight <= 4)
                return 3.66;
            else if (weight <= 8)
                return 4.39;
            else if (weight <= 12)
                return 5.19;
            else
                return 5.71;
    }
}

function getRate(req, res) {
    var weight = req.query.weight;
    var mail_type = req.query.mail_type;

    var rate = calculateRate(weight, mail_type);

    var mailing_info = {weight: weight, mail_type: mail_type, rate: rate};

    res.render('results', mailing_info);
}

module.exports = {getRate: getRate};