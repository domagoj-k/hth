/*
     GNU General Public License version 2 or later; see LICENSE.txt
 @author      JoomVita - http://www.joomvita.com
*/
var vitabook = {
    currentId: 0,
    currentType: "none",
    reset: function () {
        document.id("vbMessageFormSubmitButton").disabled = !1;
        document.id("vbAjaxBusy").hide();
        if ("edit" == vitabook.currentType) {
            tinymce.get("jform_message").setContent(document.id("vbMessageMessage_" + vitabook.currentId).getFirst("div.vbMessageText").get("html"));
            var a = document.id("vbMessage_" + vitabook.currentId);
            document.id("jform_name").set("value", a.get("data-name"));
            document.id("jform_email").set("value", a.get("data-email"));
            document.id("jform_site") && document.id("jform_site").set("value", a.get("data-site"));
            document.id("jform_location") &&
                document.id("jform_location").set("value", a.get("data-location"))
        } else document.id("vitabookMessageForm").reset(), tinymce.get("jform_message").setContent(""), "reply" == vitabook.currentType && (document.id("jform_parent_id").value = vitabook.currentId)
    },
    fresh: function () {
        if ("fresh" != vitabook.currentType) {
            if ("reply" == vitabook.currentType) document.id("jform_parent_id").value = 1, tinymce.execCommand("mceRemoveControl", !0, "jform_message"), document.id("vbFormHolder").grab(document.id("vbMessageForm")), vitabook.currentId = 0;
            else if ("none" != vitabook.currentType) {
                vitabook.cancel(vitabook.fresh);
                return
            }
            tinymce.execCommand("mceAddControl", !0, "jform_message");
            document.id("vbMessageForm").reveal({
                duration: 250
            });
            vitabook.currentType = "fresh";
            var a = document.id("vbMessageForm").getPosition();
            window.scrollTo(a.x, a.y - 100);
            vitabook.grabFocus()
        }
    },
    reply: function (a) {
        if ("fresh" == vitabook.currentType) tinymce.execCommand("mceRemoveControl", !0, "jform_message");
        else if ("reply" == vitabook.currentType) tinymce.execCommand("mceRemoveControl", !0, "jform_message");
        else if ("none" != vitabook.currentType) {
            vitabook.cancel(vitabook.reply.bind(this,
                a));
            return
        }
        document.id("jform_parent_id").value = a;
        document.id("vbMessageChildren_" + a).adopt(document.id("vbMessageForm"));
        tinymce.execCommand("mceAddControl", !0, "jform_message");
        document.id("vbMessageForm").reveal({
            duration: 250
        });
        var b = document.id("vbMessageForm").getPosition();
        window.scrollTo(b.x, b.y);
        vitabook.grabFocus();
        vitabook.currentId = a;
        vitabook.currentType = "reply"
    },
    edit: function (a) {
        if ("none" != vitabook.currentType) vitabook.cancel(vitabook.edit.bind(this, a));
        else {
            var b = document.id("vbMessage_" + a).getFirst("div.vbMessageText").get("html");
            document.id("jform_message").set("value",
                b);
            b = document.id("vbMessage_" + a);
            document.id("jform_name").set("value", b.get("data-name"));
            document.id("jform_email").set("value", b.get("data-email"));
            document.id("jform_site") && document.id("jform_site").set("value", b.get("data-site"));
            document.id("jform_location") && document.id("jform_location").set("value", b.get("data-location"));
            document.id("jform_parent_id").set("value", b.get("data-parent_id"));
            document.id("vbMessage_" + a).getParent().grab(document.id("vbMessageForm"), "top");
            (function () {
                tinymce.execCommand("mceAddControl", !0, "jform_message")
            }).delay(50);
            document.id("jform_id").set("value", a);
            document.id("vbMessage_" +
                a).hide();
            document.id("vbMessageForm").reveal({
                duration: 250
            });
            vitabook.currentId = a;
            vitabook.currentType = "edit"
        }
    },
    cancel: function (a) {
        var b = 0;
        switch (vitabook.currentType) {
        case "edit":
            document.id("vbMessageForm").hide();
            document.id("vbMessage_" + vitabook.currentId).set("opacity", 0.5);
            document.id("vbMessage_" + vitabook.currentId).show();
            Browser.ie && 9 > Browser.version ? document.id("vbMessage_" + vitabook.currentId).set("opacity", 1) : document.id("vbMessage_" + vitabook.currentId).tween("opacity", 1);
            document.id("vitabookMessageForm").reset();
            break;
        case "reply":
            document.id("vbMessageForm").hide();
            document.id("jform_parent_id").value = 1;
            break;
        case "fresh":          
            vitabook.reset(), b = 200
        }
    },
    loadChildren: function (a, b, c) {
        (new Request.HTML({
            url: vitabook.url_base,
            onRequest: function () {
                document.id("vbLoadMoreMessages_" + b + "_" + c).set("opacity", 0.5);
                document.id("vbLoadMoreMessages_" + b + "_" + c).set("onclick", "")
            },
            onComplete: function (a) {
                document.id("vbLoadMoreMessages_" + b + "_" + c).destroy();
                var e = document.id("vbMessageChildren_" + b).getChildren("div");
                document.id("vbMessageChildren_" + b).adopt(a);
                document.id("vbMessageChildren_" + b).adopt(e)
            }
        })).get("task=vitabook.getMessages&start=" + c + "&format=raw&" + vitabook.token + "=1&parent_id=" + b)
    },
    state: function (a, b) {
        var c = "unpublish";
        if (0 == document.id("vbMessage_" + b).get("data-published") || document.id("vbMessageTop_" +
            b).hasClass("vbMessageUnActivated")) c = "publish";
        (new Request.JSON({
            url: vitabook.url_base,
            onSuccess: function (a) {
                1 === a.success ? (document.id("vbMessage_" + b).set("data-published", a.state), document.id("vbMessageStateControl_" + b).src = a.state ? document.id("vbMessageStateControl_" + b).src.replace("offline", "online") : document.id("vbMessageStateControl_" + b).src.replace("online", "offline"), vitabook.visualState(b, a.state)) : alert(a.state)
            }
        })).get("task=message." + c + "&messageId=" + b + "&" + vitabook.token + "=1&format=raw")
    },
    remove: function (a, b) {
        (new Request.JSON({
            url: vitabook.url_base,
            onSuccess: function (a) {
                1 === a.success ? (document.id("vbMessage_" + b).getParent().dissolve({
                    duration: 250
                }), function () {
                    document.id("vbMessage_" + b).getParent().destroy()
                }.delay(250)) : alert(a.state)
            }
        })).get("task=message.delete&messageId=" + b + "&" + vitabook.token + "=1&format=raw")
    },
    save: function () {
        tinyMCE.triggerSave();
		
        /*vitabook.validate() ?*/  (new Request.JSON({
            url: vitabook.url_base,
            method: "post",
            data: document.id("vitabookMessageForm"),
            onSuccess: function (a) {
                switch (a.state) {
                case 1:
                    "edit" == vitabook.currentType ? ((new Request.HTML({
                        url: vitabook.url_base,
                        onComplete: function (b) {
                            var c = document.id("vbMessageTop_" + a.result).getParent(),
                                d = document.id("vbMessageChildren_" + a.result).getChildren("div");
                            document.id("vbMessageTop_" + a.result).destroy();
                            c.adopt(b);
                            document.id("vbMessageChildren_" + a.result).adopt(d)
                        }
                    })).get("task=message.getMessage&format=raw&messageId=" + a.result + "&" + vitabook.token + "=1"), vitabook.cancel()) : ("fresh" == vitabook.currentType && (new Request.HTML({
                        url: vitabook.url_base,
                        onComplete: function (a) {
                            var c = document.id("vbMessages").getChildren("div");
                            document.id("vbMessages").adopt(a);
                            document.id("vbMessages").adopt(c);
                            vitabook.cancel();
                            document.id("vbNoMessages") && document.id("vbNoMessages").destroy()
                        }
                    })).get("task=message.getMessage&format=raw&messageId=" + a.result + "&" + vitabook.token + "=1"), "reply" == vitabook.currentType && (new Request.HTML({
                        url: vitabook.url_base,
                        onComplete: function (a) {
                            document.id("vbMessageChildren_" + vitabook.currentId).adopt(a);
                            vitabook.cancel()
                        }
                    })).get("task=message.getMessage&format=raw&messageId=" + a.result + "&" + vitabook.token + "=1"));
                    break;
                case 2:
                    vitabook.cancel();
                    (function () {
                        alert(a.result)
                    }).delay(260);
                    break;
                case 0:
                    alert(a.result),
                        "undefined" != typeof Recaptcha && Recaptcha.reload(), document.id("vbMessageFormSubmitButton").disabled = !1, document.id("vbAjaxBusy").hide()
                }
            }
        })).send() /*: (document.id("vbMessageFormSubmitButton").disabled = !1, document.id("vbAjaxBusy").hide())*/;

        return !1
    },
    grabFocus: function () {
        "" == document.id("jform_name").value ? document.id("jform_name").focus() : function () {
            tinyMCE.execCommand("mceFocus", !1, "jform_message")
        }.delay(100)
    },
    visualState: function (a, b) {
        0 == b ? document.id("vbMessageTop_" + a).addClass("vbMessageUnpublished") : document.id("vbMessageTop_" + a).hasClass("vbMessageUnActivated") ? document.id("vbMessageTop_" +
            a).removeClass("vbMessageUnActivated") : document.id("vbMessageTop_" + a).removeClass("vbMessageUnpublished")
    }
};