Handlebars.registerHelper("null_empty", function (value, options) {
    if (!value || value == null || value == "")
        return options.fn(this);
    else
        return options.inverse(this);
});

Handlebars.registerHelper("not_null_empty", function (value, options) {
    if (value && value != null && value != "")
        return options.fn(this);
    else
        return options.inverse(this);
});

Handlebars.registerHelper('row_class', function (number) {
    if (number % 2 == 0)
        return 'event';
    else
        return 'odd';
});

Handlebars.registerHelper('addition', function (number1, number2) {
    return number1 + number2;
});

Handlebars.registerHelper('stt_pager', function (index, page, size) {
    return (page - 1) * size + index + 1;
});

Handlebars.registerHelper('upper', function (content) {
    if (content)
        return content.toUpperCase();
    else
        return content;
});

Handlebars.registerHelper('checked', function (content) {
    if (content)
        return "checked";
    else
        return "";
});

Handlebars.registerHelper('unchecked', function (content) {
    if (!content)
        return "checked";
    else
        return "";
});

Handlebars.registerHelper('checkIcon', function (content) {
    if (content)
        return new Handlebars.SafeString('<i class="fa fa-check"></i>');
    else
        return '';
});

Handlebars.registerHelper('if_eq', function (a, b, opts) {
    if (a === b) // Or === depending on your needs
        return opts.fn(this);
    else
        return opts.inverse(this);
});

Handlebars.registerHelper('if_noteq', function (a, b, opts) {
    if (a !== b) // Or === depending on your needs
        return opts.fn(this);
    else
        return opts.inverse(this);
});