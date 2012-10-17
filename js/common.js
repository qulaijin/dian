/*搜搜*/
$(document).ready(function() {
    //each遍历文本框
    $("#main .search input").each(function() {
        //保存当前文本框的值
        var vdefault = this.value;
        $(this).focus(function() {
            //获得焦点时，如果值为默认值，则设置为空
            if (this.value == vdefault) {
                this.value = "";
            }
        });
        $(this).blur(function() {
            //失去焦点时，如果值为空，则设置为默认值
            if (this.value == "") {
                this.value = vdefault;
            }
        });
    });
    //
     $(".topnav .lsearch input").each(function() {
        //保存当前文本框的值
        var vdefault = this.value;
        $(this).focus(function() {
            //获得焦点时，如果值为默认值，则设置为空
            if (this.value == vdefault) {
                this.value = "";
            }
        });
        $(this).blur(function() {
            //失去焦点时，如果值为空，则设置为默认值
            if (this.value == "") {
                this.value = vdefault;
            }
        });
    });
    
    $(".continfo input").each(function() {
        //保存当前文本框的值
        var vdefault = this.value;
        $(this).focus(function() {
            //获得焦点时，如果值为默认值，则设置为空
            if (this.value == vdefault) {
                this.value = "";
            }
        });
        $(this).blur(function() {
            //失去焦点时，如果值为空，则设置为默认值
            if (this.value == "") {
                this.value = vdefault;
            }
        });
    });
    
    
    //
 
    
    
    
});

/*$(document).ready(function() {	
   $.ui.autocomplete.prototype._renderItem = function (ul, item) {   
            return $("<li></li>")   
                    .data("item.autocomplete", item)   
                    .append("<a>" + item.label + "<span style='float:right;'>约<font style='color:#f50;'>"+item.amount+"</font>件产品</span></a>")   
                    .appendTo(ul);   
    };   
  
    //这里的ajax返回类型可以随自己定义，本代码后台把字符串传给前台，  
    $("#search-key").autocomplete({  
        source: function(request, response){  
            $.ajax({  
                url: "index.php/Search/dosync",  
                type: "GET",  
                data:"/k/"+$('#search-key').val(),  
                success:function(xml_data){  
                    var tj_array=xml_data.split(",");  //代码是通过"_"分割  
                    response($.map(tj_array,function(item){  
                        return {  
                            label:item
                        }  
                    }));  
                }  
            });  
        },  
        minLength: 1    //搜索时，最少1个字符时出结果  
    }); 
});
*/

