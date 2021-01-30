define(
    rules = {
        "mobileIN": [
            function(value) {
                return value.length > 9 && value.length < 11 && value.match(/^\d{10}$/);
            },
            $.mage.__('Please specify a 10 digit valid mobile number')
        ]
    }
)

