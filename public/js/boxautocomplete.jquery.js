/*!
 * Bootstrap BoxAutocomplete Selector v0.1.0 (https://github.com/Djagu/bootstrap-boxautocomplete-selector.git)
 *
 * Copyright 2013-2014 bootstrap-boxautocomplete-selector
 * Licensed under MIT (https://github.com/silviomoreto/bootstrap-select/blob/master/LICENSE)
 */
(function($) {

    $.fn.boxautocomplete = function (options) {

        let settings = $.extend({
            data: [],
            dataUrl: false,
            valueFormat: 'text', // text|json
            delemiter: ";",
            hideInput: true,
            search: false,
            searchPlaceholder: "Search for an element...",
            searchButtonText: "Clear",
            searchMin: 1,
            uniqueValue: true,
            getItem: function (dataItem, valueFormat) {
                let item = '<li class="list-group-item">\
                    <a href="#" class="ba-add"><span class="ba-name"></span>\
                    <button type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-right"></i></button>\
                    </a>\
                    <a href="#" class="ba-remove d-none"><span class="ba-name"></span>\
                    <button type="button" class="btn btn-primary btn-sm float-left"><i class="fa fa-times"></i></button>\
                    </a>\
                    </li>';
                let jItem = $(item);
                jItem.find('.ba-name').html(dataItem.name);
                if (valueFormat == "json") {
                    let dataClone = jQuery.extend(true, {}, dataItem);
                    delete dataClone.baSelected;
                    jItem.attr('data-ba-value', JSON.stringify(dataClone));
                } else {
                    jItem.attr('data-ba-value', dataItem.value);
                }
                return jItem;
            },
            updateInput: function (jInput, valueFormat) {
                if (jInput !== undefined) {
                    jInput.val('');
                    jInput.attr('value', '');
                    let items = jInput.closest('.ba-box-autocomplete').find('.ba-selected-items .list-group-item');
                    let itemSelected = [];
                    items.each(function (index) {
                        if (valueFormat == "json") {
                            itemSelected.push(jQuery.parseJSON($(this).attr('data-ba-value')));
                            // Put it in the val for the last item
                            if (items.length == (index + 1)) {
                                jInput.val(JSON.stringify(itemSelected));
                            }
                        } else {
                            jInput.val(jInput.val() + $(this).attr('data-ba-value') + settings.delemiter);
                        }
                    });
                    jInput.attr('value', jInput.val());
                }
            },
            updateDataList: function (data) {

            },
            searchFilterBy: function (itemsContainer, filter) {
                if (itemsContainer !== undefined) {
                    itemsContainer.find('.list-group-item').each(function () {
                        let li = $(this).find('.ba-name').eq(0).text().toLowerCase().indexOf(filter.toLowerCase());
                        li != -1 ? $(this).show() :$(this).hide();
                    });
                }
            }
        }, options);


        let ba = this;

        this.isValueInData = function (value) {
            let found = false;
            let params;
            this.each(function (index) {
                let cItems = $(this).closest('.ba-box-autocomplete').find('.ba-available-items .list-group-item');
                let cItems2 = $(this).closest('.ba-box-autocomplete').find('.ba-selected-items .list-group-item');
                cItems.add(cItems2);
                cItems.each(function () {
                    params = jQuery.parseJSON($(this).attr('data-ba-value'));
                    if ((settings.valueFormat == "json" && params.value == value) || (settings.valueFormat == "text" && params == value)) {
                        found = true;
                        return true;
                    }
                });
                if (found == true) {
                    return true;
                }
            });
            return found;
        };

        this.addDataItem = function (iData, iContainer) {
            let max = 1;
            let cContainer;
            if (iContainer === undefined) {
                max = ba.length;
            }
            let items = [];

            if (settings.uniqueValue === true && (iData === undefined || iData.value === undefined || ba.isValueInData(iData.value))) {
                return items;
            }

            for (let l = 0; l < max; l++) {
                cContainer = iContainer === undefined ? ba.eq(l).parent().find('.ba-available-items') : cContainer = iContainer;
                let item = settings.getItem(iData, settings.valueFormat);
                // Attaching click event
                item.find('.ba-add').off('click').click(function (e) {
                    e.preventDefault();
                    $(this).toggleClass('d-none');
                    let k = $(this).closest('.list-group-item');
                    k.find('.ba-remove').toggleClass('d-none');
                    selected = $(this).closest('.ba-box-autocomplete').find('.ba-selected-items');
                    selected.scrollTop(selected[0].scrollHeight + 50);
                    k.appendTo(selected);
                    settings.updateInput(cContainer.closest('.ba-box-autocomplete').find('input:not(.ba-search)'), settings.valueFormat);
                });
                item.find('.ba-remove').off('click').click(function (e) {
                    e.preventDefault();
                    $(this).toggleClass('d-none');
                    let k = $(this).closest('.list-group-item');
                    k.find('.ba-add').toggleClass('d-none');
                    k.appendTo($(this).closest('.ba-box-autocomplete').find('.ba-available-items'));
                    settings.updateInput(cContainer.closest('.ba-box-autocomplete').find('input:not(.ba-search)'), settings.valueFormat);
                });
                cContainer.append(item);
                items.push(item);
            }
            return items;
        };

        this.addSelectedItem = function (item) {
            let ret = ba.addDataItem(item);
            for (let r in ret) {
                ret[r].find('.ba-add').click();
            }
        };


        let readyDataLaunch = function (el) {
            // For each input on which we would like to put the box autocomplete
            let selectedContainer;
            let availableContainer;
            let inputValue;
            let isInvalid = " is-invalid";
            el.each(function () {
                if (settings.hideInput === true) {
                    $(this).hide();
                }
                $(this).wrap('<div class="row ba-box-autocomplete' + isInvalid + '"></div>');
                $(this).before('<div class="col-md-6"><ul class="list-group ba-available-items"></ul></div>');
                $(this).before('<div class="col-md-6"><ul class="list-group ba-selected-items"></ul></div>');
                availableContainer = $(this).parent().find('.ba-available-items');

                // Append the items that can appear in the input value by default
                inputValue = $(this).attr('value');
                if (inputValue !== undefined && inputValue.length > 0) {
                    inputValue = $.parseJSON(inputValue);
                    for (let i in inputValue) {
                        inputValue[i].baSelected = true;
                        settings.data.push(inputValue[i]);
                    }
                }

                // Search functionnality
                if (settings.search === true) {
                    availableContainer.prepend($('<div class="input-group ba-search-row">\
                        <input type="text" class="form-control ba-search" placeholder="' + settings.searchPlaceholder + '">\
                        <span class="input-group-btn">\
                        <button class="btn btn-primary ba-search-clear" type="button">' + settings.searchButtonText + '</button>\
                        </span></div>'));
                    let searchInput = availableContainer.find('input.ba-search');

                    availableContainer.find('.ba-search-clear').click(function (e) {
                        e.preventDefault();
                        searchInput.val("");
                        settings.searchFilterBy($(this).closest(".ba-available-items"), "");
                    });

                    searchInput.keyup(function (e) {
                        if ($(this).val().length >= settings.searchMin) {
                            settings.searchFilterBy($(this).closest('.ba-available-items'), $(this).val());
                        } else {
                            // Reset data list
                            settings.searchFilterBy($(this).closest(".ba-available-items"), "");
                        }
                    });

                }
                let items;
                for (let i in settings.data) {
                    items = ba.addDataItem(settings.data[i], availableContainer);
                    if (settings.data[i].baSelected == true) {
                        for (let j in items) {
                            items[j].find('.ba-add').click();
                        }
                    }
                }
            });
        };

        // Getting the DATA if the dataUrl is set
        if (settings.dataUrl !== false) {
            let that = this;
            settings.data = [];
            $.get(settings.dataUrl).then(function (data) {
                settings.data = jQuery.parseJSON(data);
                readyDataLaunch(that);
            });
        } else {
            readyDataLaunch(this);
        }
        return this;
    };

}(jQuery));
