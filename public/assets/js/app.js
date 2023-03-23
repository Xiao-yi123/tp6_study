app = {
    ajax: (url, data, success, dataType = 'json') => {
        let loading = layer.load(2);
        $.ajax({
            url: url,
            data: data,
            type: (data === null || data === undefined) ? 'GET' : 'POST',
            cache: false,
            dataType: dataType,
            success: (data) => {
                app.close(loading);
                if (typeof (success) === 'function') {
                    success(data)
                }
            },
            error: (data) => {
                app.close(loading);
                if (typeof (fail) === 'function') {
                    fail(data)
                } else {
                    app.notify('网络链接错误', 'danger');
                }
            }
        })
    },
    /**
     *
     * @param url 链接
     * @param parameter 参数
     * @param callback 回调
     * @param ajaxType POST/GET
     * @param ajaxTime Time || 60000
     */
    postData: (url, parameter, callback, ajaxType, ajaxTime) => {
        ajaxType = ajaxType || "POST";
        ajaxTime = ajaxTime || 60000;
        let loading = layer.load(2);
        $.ajax({
            type: ajaxType,
            url: url,
            async: true,
            dataType: 'json',
            timeout: ajaxTime,
            data: parameter,
            success: (data) => {
                app.close(loading);
                if (callback == null) {
                    return;
                }
                callback(data);
            },
            error: (error) => {
                app.close(loading);
                app.notify('网络链接错误', 'danger');
            }
        });
    },

    getval: (b, a) => {
        if ($(b).length === 0) {
            return ""
        }
        if (a === null) {
            $(b).val("");
            return
        } else {
            if (!$(b).val()) {
                if (a === 1) {
                    $(b).focus()
                } else {
                    if (a) {
                        $(b).focus();
                        app.notify(a, 'danger')
                    }
                }
                return ""
            }
            return $(b).val()
        }
    },
    /**
     *
     * @param message 描述
     * @param type 类型(info/success/warning/danger)
     * @param align 显示位置(top/bottom)
     */
    notify: function (message, type = 'info', align = 'right') {
        switch (type) {
            case 'info':
                icon = 'fa fa-info me-1';
                break;
            case 'success':
                icon = 'fa fa-check me-1';
                break;
            case 'warning':
                icon = 'fa fa-exclamation-triangle me-1';
                break;
            case 'danger':
                icon = 'fa fa-times me-1';
                break;
        }
        Codebase.helpers('jq-notify', {
            align: align,           // 'right', 'left', 'center'
            from: 'top',            // 'top', 'bottom'
            type: type,             // 'info', 'success', 'warning', 'danger'
            icon: icon,             // Icon class
            message: message,
        });
    },
    pjax: (url) => {
        $.pjax({
            url: url,
            container: '#pjax-container',
            scrollTo: false,
            timeout: 20000,
        });
    },
    reload: () => {
        $("#nav-main a").each(function () {
            let pageUrl = window.location.href.split(/[#]/)[0]; // window.location.href.split(/[?#]/)[0];
            if (this.href === pageUrl && window.location.href.split(/[?#]/)[0]) {
                $(this).parent().parent().parent().addClass("open");
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    },
    close: (a) => {
        if (typeof (a) === "number") {
            layer.close(a)
        } else {
            if (a) {
                layer.closeAll(a)
            } else {
                layer.closeAll()
            }
        }
    },
    btn: (d, a) => {
        let e;
        if (d) {
            e = d;
        } else {
            e = 'NULL';
        }
        return layer.confirm(e, {
            btn: a || '我知道了',
            closeBtn: 0,
            btnAlign: "c",
            yes: (b) => {
                app.close(b)
            }
        })
    },
    /**
     *
     * @param c 链接
     * @param g 参数
     * @param b 回调方法
     * @param a 弹窗文本
     */
    del: (c, g, b, a) => {
        var a = nv(a, "您确定要删除吗?");
        layer.confirm(a, {
            btn: ["确 定", "取 消"]
        }, function (d) {
            app.close(d)
            app.postData(c, g, b)
        })
    },
    ints: (b, e, a) => {
        e = nv(e, 11);
        let d = $(b).val();
        let c = event.which;
        if (a) {
            if (c == 46) {
                if (d.length < 1 || d.indexOf(".") > 0) {
                    return false
                } else {
                    return true
                }
            }
        }
        if (c >= 48 && c <= 57) {
            if (d.length < e) {
                return true
            }
        }
        return false
    }, mode: (url, parameter, bt, se) => {
        se ? eval(se) : $("#modal").modal("show");
        let BT = bt || '标题文本';
        get_url(url, parameter, BT);
    },
    // 柱行图表
    barCharts: (a, b, c) => {
        (Chart.defaults.color = "#818d96"),
            (Chart.defaults.scale.grid.color = "rgba(0,0,0,.04)"),
            (Chart.defaults.scale.grid.zeroLineColor = "rgba(0,0,0,.1)"),
            (Chart.defaults.scale.beginAtZero = !0),
            (Chart.defaults.elements.line.borderWidth = 2),
            (Chart.defaults.elements.point.radius = 5),
            (Chart.defaults.elements.point.hoverRadius = 7),
            (Chart.defaults.plugins.tooltip.radius = 3),
            (Chart.defaults.plugins.legend.labels.boxWidth = 12);
        d = document.getElementById("js-chartjs-bars"),
            f = {
                labels: a,
                datasets: [
                    {
                        label: "API调用",
                        fill: !0,
                        backgroundColor: "rgba(2, 132, 199, .75)",
                        borderColor: "rgba(2, 132, 199, 1)",
                        pointBackgroundColor: "rgba(2, 132, 199, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(2, 132, 199, 1)",
                        data: b
                    },
                    {
                        label: "IP数量",
                        fill: !0,
                        backgroundColor: "rgba(2, 132, 199, .25)",
                        borderColor: "rgba(2, 132, 199, 1)",
                        pointBackgroundColor: "rgba(2, 132, 199, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(2, 132, 199, 1)",
                        data: c
                    }
                ]
            };
        new Chart(d, {
            type: "bar",
            data: f
        })
    }


}

/**
 * 删除两端空格
 * @param a
 * @returns {*}
 */
function trim (a)
{
    return a.replace(/(^\s*)|(\s*$)/g, "")
}

/**
 *
 * @function isnull
 * @param { any } a - 需要检查的输入参数
 * @returns { boolean } - 如果输入参数为 null 或空字符串, "undefined", false, "false" 或 "null",则返回 true。否则返回 false。
 *
 * 'isnull' 函数用于检查输入参数 'a' 是否为 null 或空字符串。
 * 检查输入参数是否符合以下任何一种条件:
 * - a == null
 * - a == "" (空字符串)
 * - a == "undefined"
 * - a == undefined
 * - a == false
 * - a == "false"
 * - a == "null"
 * 如果任意一种条件为真, 则函数返回 true。否则返回 false。
 */
function isnull (a)
{
    if (a == null || a == "" || a == "undefined" || a == undefined || a == false || a == "false" || a == "null") {
        return true
    }
    return false
}

function nv (b, a)
{
    return (isnull(b)) ? (!isnull(a) ? a : "") : b
}

$.fn.parseForm = function () {
    let serializeObj = {};
    let array = this.serializeArray();
    let str = this.serialize();
    $(array).each(function () {
        if (serializeObj[this.name]) {
            if ($.isArray(serializeObj[this.name])) {
                serializeObj[this.name].push(this.value);
            } else {
                serializeObj[this.name] = [serializeObj[this.name], this.value];
            }
        } else {
            serializeObj[this.name] = this.value;
        }
    });
    return serializeObj;
};

/*** 模态窗口调用 ***/
function get_url (url, parameter, bt)
{
    $("#modal-title").html(bt);
    $("#modal-content").html("<div class=\"text-center mb-4\"><i class=\"far fa-2x fa-sun fa-spin\"></i></div>")
    console.log(parameter)
    app.postData(
        url, parameter, function (d) {
            $("#modal-content").html(d.content);
            return false
        }, function (d) {
            $("#modal-content").html("<p style='text-align: center;margin:20px auto;'><b>加载失败，请稍后重试！</b></p>")
            return false
        }, 'POST'
    );
}

$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container', {
    type: 'get',
    scrollTo: false,
    timeout: 20000,
});
$(document).on('pjax:send', function () {
    NProgress.start();
});
$(document).on('pjax:complete', function () {
    if (window.innerWidth <= 991) {
        Codebase.layout('sidebar_close');
    }
    NProgress.done();
    app.reload();
});

app.reload();


let clipboard = new ClipboardJS('.copy');
clipboard.on('success', (e) => {
    app.notify("复制成功", "success");
});
clipboard.on('error', (e) => {
    document.querySelector('.copy');
    app.notify("复制失败", "warning");
});