(function(){
    var $ = jQuery;
    var tags = {
        101 : {
            tag : 'Word meaning',
            childs_count : 4,
            childs : {
                102 : {
                    tag : 'Confusing words',
                    childs_count : 4,
                    childs : {
                        103 : 'Noun',
                        104 : 'Adjective',
                        105 : 'Adverb',
                        106 : 'Verb'
                    }
                },
                107 : {
                    tag : 'Jargon',
                    childs_count : 0,
                    childs : {

                }
                },
                108 : {
                    tag : 'Phrasal verb',
                    childs_count : 0,
                    childs : {

                }
                },
                158 : {
                    tag : 'Spelling-Pronunciation'
                },
                109 : {
                    tag : 'Abbreviation - Acronym'
                }
            }
        },
        110 : {
            tag : 'Grammar',
            childs_count : 6,
            childs : {
                111 : {
                    tag : 'Tenses',
                    childs_count : 3,
                    childs : {
                        112 : 'Present',
                        113 : 'Past',
                        114 : 'Future'
                    }
                },
                115 : {
                    tag : 'Noun',
                    childs_count : 5,
                    childs : {
                        116 : 'Count - Uncount noun',
                        117 : 'Collective noun',
                        118 : 'Adjectival noun',
                        119 : 'Attributive noun',
                        120 : 'Noun phrase'
                    }
                },
                121 : {
                    tag : 'Verb',
                    childs_count : 5,
                    childs : {
                        122 : 'Auxiliary - Modal verb',
                        123 : 'Transitive - Intransitive verb',
                        124 : 'Irregular verb',
                        125 : 'Infinitive - Gerund',
                        126 : 'Stative verb'
                    }
                },
                127 : {
                    tag : 'Adjective',
                    childs_count : 2,
                    childs : {
                        128 : 'Position',
                        129 : 'Comparative - Superlative adjective'
                    }
                },
                130 : {
                    tag : 'Preposition',
                    childs_count : 0,
                    childs : {
                }
                },
                131 : {
                    tag : 'Grammar structure',
                    childs_count : 8,
                    childs : {
                        135 : 'Relative clause',
                        136 : 'Conditional sentence',
                        137 : 'Passive voice',
                        138 : 'Tag question',
                        139 : 'Article',
                        140 : 'Reported speech',
                        141 : 'Spelling - Pronunciation',
                        142 : 'Writing'
                    }
                }
            }
        },
        143 : {
            tag : 'Translation',
            childs_count : 3,
            childs : {
                144 : {
                    tag : 'Idiom - Proverb',
                    childs_count : 0,
                    childs : {

                }
                },
                145 : {
                    tag : 'Slang - Expression',
                    childs_count : 0,
                    childs : {

                }
                },
                146 : {
                    tag : 'Sentence',
                    childs_count : 0,
                    childs : {

                }
                }
            }
        },
        147 : {
            tag : 'Sharing tips',
            childs_count : 4,
            childs : {
                148 : {
                    tag : 'English test',
                    childs_count : 5,
                    childs : {
                        149 : 'IELTS',
                        150 : 'TOEFL',
                        151 : 'TOEIC',
                        152 : 'GMAT',
                        153 : 'GRE'
                    }
                },
                154 : {
                    tag : 'Where to go',
                    childs_count : 0,
                    childs : {

                }
                },
                155 : {
                    tag : 'Books',
                    childs_count : 0,
                    childs : {

                }
                },
                156 : {
                    tag : 'Website',
                    childs_count : 0,
                    childs : {

                }
                }
            }
        }
    }
    
    tagLists = [];
	
    function createTagListHtml(tags, selectedTags) {
        var html = '<div class="tagselect"><div class="left-menu"><ul>';
        for (var id in tags) {
            var tagLevel1 = tags[id];
            tagLists.push({
                id : id,
                name : tagLevel1.tag
            });
            html += '<li' + (tagLevel1.childs_count ? ' class="hasChild"' : '') + '>';
            html += '<a href="#" id="t_t_'+createTagShort(tagLevel1.tag)+'" data-id="'+id+'" data-short="' + createTagShort(tagLevel1.tag) + '" class="tag ' + (tagLevel1.childs_count ? 'arrow' : '') + (selectedTags.indexOf(createTagShort(tagLevel1.tag)) != -1 ? ' active' : '') + '"><div class="fleft' + (tagLevel1.childs_count ? ' foldr' : '') + '"></div>' + tagLevel1.tag + '</a>';
            if (tagLevel1.childs_count) {
                html += '<div class="recent"><div><ul>';
                for (var id2 in tagLevel1.childs) {
                    var tagLevel2 = tagLevel1.childs[id2];
                    tagLists.push({
                        id : id2,
                        name : tagLevel2.tag
                    });
                    html += '<li' + (tagLevel2.childs_count ? ' class="hasChild"' : '') + '>';
                    html += '<a href="#" id="t_t_'+createTagShort(tagLevel2.tag)+'" data-id="'+id2+'" data-short="' + createTagShort(tagLevel2.tag) + '" class="tag ' + (tagLevel2.childs_count ? 'arrow' : '') + (selectedTags.indexOf(createTagShort(tagLevel2.tag)) != -1 ? ' active' : '') + '"><div class="fleft' + (tagLevel2.childs_count ? ' foldr' : '') + '"></div>' + tagLevel2.tag + '</a>';
                    if (tagLevel2.childs_count) {
                        html += '<div class="recent"><div><ul>';
                        for (var id3 in tagLevel2.childs) {
                            var tagLevel3 = tagLevel2.childs[id3];
                            tagLists.push({
                                id : id3,
                                name : tagLevel3
                            });
                            html += '<li><a href="#" id="t_t_'+createTagShort(tagLevel3)+'" data-id="'+id3+'" data-short="' + createTagShort(tagLevel3) + '" class="tag ' + (selectedTags.indexOf(createTagShort(tagLevel3)) != -1 ? ' active' : '') + '">' + tagLevel3 + '</a></li>';
                        }
                        html += '</ul></div></div>';
                    }
                    html += '</li>';
                }
                html += '</ul></div></div>';
            }
            html += '</li>';
        }
        html += '</ul></div><div></div><div></div><div class="clear"></div></div>';
        return html;
    }
	
    displayTags = function(obj, selectedTags){
        $(obj).html(createTagListHtml(tags, selectedTags));
        
        var tagSelect = $(".tagselect", $(obj));

        $(".left-menu > ul > li > div > div > ul > li.hasChild", tagSelect).hover(function() {
            tagSelect.addClass('level3');
        }, function() {
            tagSelect.removeClass('level3');
        });
        $(".left-menu > ul > li.hasChild", tagSelect).hover(function() {
            tagSelect.addClass('level2');
        }, function() {
            tagSelect.removeClass('level2');
        });
        
        $("#tags").tokenInput(tagLists, {
            theme : 'facebook',
            onAdd : function(item){
                if(!$("#t_t_" + item.id).hasClass('active'))
                    $("#t_t_" + item.id).click();
            }, 
            onDelete : function(item){
                if($("#t_t_" + item.id).hasClass('active'))
                    $("#t_t_" + item.id).click();
            }
        });
        
        $("a.tag", tagSelect).click(function(){
            $(this).toggleClass('active');
            if($(this).hasClass('active')){
                $("#tags").tokenInput('add', {
                    id : $(this).data('short'), 
                    name : $(this).text()
                    });
            } else {
                $("#tags").tokenInput('remove', {
                    id : $(this).data('short'), 
                    name : $(this).text()
                    });
            }
            return false;
        });
    }
    var div = $("#populartags > .tags");
    if(div.size()){
        div.html(createTagListHtml(tags, []));
    }
    
    function createTagShort(tag) {
        return tag.toLowerCase().replace(/[^a-z0-9A-Z]+/gi, '-');
    }
})();