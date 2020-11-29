


$(document).ready(function() {
    let selects = $(".custom-select");

    selects.each(function(index) {
        let old_select = $(this);

        let new_options = $('<ul class="options"></ul>')
        let new_select = $('<div class="select"><span>' + old_select.children(":selected").text() + '</span><img src="./icon/caret.svg"></img></div>');

        new_select.append(new_options);

        old_select.children().each(function() {
            let value = $(this).val();

            $('<li>' + $(this).text() + '</li>')
                .click(function() {
                    old_select.val(value).change();

                    new_select.children("span").text($(this).text());
                })
                .appendTo(new_options);
        });


        new_select.insertAfter($(this));
        
        new_select.click(function() {
            new_select.find("img").toggleClass("flipped");
            content = new_options[0];

            if (content.style.maxHeight){
                content.style.maxHeight = null;
			} else {
                content.style.maxHeight = content.scrollHeight + "px";
			}

        });
    });

});

