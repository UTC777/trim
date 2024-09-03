$('.check-all').click(function() {
  type = $(this).attr('checkType');
  $('.' + type + '-input:checkbox').prop('checked', true);

  var arr = [];

  $('input[name="conditionals[]"]:checked').each(function() {
      arr.push({
          menu_id: $(this).attr('menuId'),
          envs: $(this).val(),
          check: 1
      });
  });

  $.ajax({
      data: { evnsData: arr },

      url: add_env_conditionals,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });

});


$('.conditionals').change(function() {

  var arr = [];
  if ($(this).prop("checked") == true) {
      arr.push({
          menu_id: $(this).attr('menuId'),
          envs: $(this).val(),
          check: 1
      });
  } else {
      arr.push({
          menu_id: $(this).attr('menuId'),
          envs: $(this).val(),
          check: 0
      });
  }

  // console.log('arr', arr);

  $.ajax({
      data: { evnsData: arr },

      url: add_env_conditionals,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });
});

$(document.body).on("change", ".select-users", function() {
  // var selected = [];
  // $('.select-users :selected').each(function() {
  //     selected.push($(this).val());
  // });

  var menuId = $(this).attr('menuId');

  var arr = { menu_id: menuId, users: $('.select-users-val' + menuId).select2('val') }
  console.log(arr);
  console.log($('.select-users-val' + menuId).select2('val'));

  $.ajax({
      data: arr,

      url: MenuUsers,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });

});

$(document.body).on("change", ".select-roles", function() {
  // var selected = [];
  // $('.select-roles :selected').each(function() {
  //     selected.push($(this).select2('val'));
  // });

  var menuId = $(this).attr('menuId');

  var arr = { menu_id: menuId, roles: $('.select-roles-val' + menuId).select2('val') }
      // console.log(arr);
  console.log($('.select-roles-val' + menuId).select2('val'));

  $.ajax({
      data: arr,

      url: MenuRoles,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });

});


$('.logged_in_only').change(function() {

  var arr = [];
  if ($(this).prop("checked") == true) {
      arr = {
          menu_id: $(this).attr('menuId'),
          check: 1
      };
      $('#select-boxes' + $(this).attr('menuId')).show();
  } else {
      arr = {
          menu_id: $(this).attr('menuId'),
          check: 0
      };
      $('#select-boxes' + $(this).attr('menuId')).hide();
  }

  // console.log('arr', arr);

  $.ajax({
      data: arr,

      url: logged_in_only,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });
});

$('.icon_only_menu').change(function() {

  var arr = [];
  if ($(this).prop("checked") == true) {
      arr = {
          menu_id: $(this).attr('menuId'),
          check: 1
      };
      $('#select-boxes' + $(this).attr('menuId')).show();
  } else {
      arr = {
          menu_id: $(this).attr('menuId'),
          check: 0
      };
      $('#select-boxes' + $(this).attr('menuId')).hide();
  }

  // console.log('arr', arr);

  $.ajax({
      data: arr,

      url: icon_only_menu,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });
});

$('.updatemenu').click(function() {

  var arr = [];

  var menu_id = $(this).attr('mid');
  var icon = $('#edit-menu-item-icon-' + menu_id).val();

  arr = {
      menu_id: menu_id,
      icon: icon
  };

  $.ajax({
      data: arr,

      url: add_menu_icon_class,
      type: 'POST',
      success: function(response) {
          // window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });
});

var arraydata = [];

function getmenus() {

  arraydata = [];
  $('#spinsavemenu').show();

  var cont = 0;
  $('#menu-to-edit li.menu-item').each(function(index) {
      var dept = 0;
      for (var i = 0; i < $('#menu-to-edit li.menu-item').length; i++) {
          var n = $(this)
              .attr('class')
              .indexOf('menu-item-depth-' + i);
          if (n != -1) {
              dept = i;
          }
      }
      var textoiner = $(this)
          .find('.item-edit')
          .text();
      var id = this.id.split('-');
      var textoexplotado = textoiner.split('|');
      var padre = 0;
      if (!!textoexplotado[textoexplotado.length - 2] &&
          textoexplotado[textoexplotado.length - 2] != id[2]
      ) {
          padre = textoexplotado[textoexplotado.length - 2];
      }
      arraydata.push({
          depth: dept,
          id: id[2],
          parent: padre,
          sort: cont
      });
      cont++;
  });
  updateitem();
  actualizarmenu();
  // addmenuenvs();
}

// function addmenuenvs() {

//     var arr = [];
//     $('input[name="conditionals[]"]:checked').map(function() {
//         arr.push({
//             menu_id: $(this).attr('menuId'),
//             envs: $(this).val()
//         });
//     });

//     $.ajax({
//         data: { evnsData: arr },

//         url: add_env_conditionals,
//         type: 'POST',
//         success: function(response) {
//             // window.location.reload();
//         },
//         complete: function() {
//             $('.spincustomu').hide();
//         }
//     });
// }

function addcustommenu(post) {
  $('.spincustomu').show();

  $.ajax({
      data: {
          labelmenu: $('#custom-menu-item-name-' + post).val(),
          linkmenu: $('#custom-menu-item-url-' + post).val(),
          rolemenu: $('#custom-menu-item-role-' + post).val(),
          idmenu: $('#idmenu').val()
      },

      url: addcustommenur,
      type: 'POST',
      success: function(response) {
          window.location.reload();
      },
      complete: function() {
          $('.spincustomu').hide();
      }
  });
}

function updateitem(id = 0) {
  console.log('#edit-menu-item-icon-' + id);
  if (id) {
      var label = $('#idlabelmenu_' + id).val();
      var clases = $('#clases_menu_' + id).val();
      var url = $('#url_menu_' + id).val();
      var icon = $('#edit-menu-item-icon-' + id).val();
      var role_id = 0;
      if ($('#role_menu_' + id).length) {
          role_id = $('#role_menu_' + id).val();
      }

      var data = {
          label: label,
          clases: clases,
          url: url,
          menu_icon_class: icon,
          role_id: role_id,
          id: id
      };
  } else {
      var arr_data = [];
      $('.menu-item-settings').each(function(k, v) {
          var id = $(this)
              .find('.edit-menu-item-id')
              .val();
          var label = $(this)
              .find('.edit-menu-item-title')
              .val();
          var clases = $(this)
              .find('.edit-menu-item-classes')
              .val();
          var url = $(this)
              .find('.edit-menu-item-url')
              .val();
          var icon = $(this)
              .find('.edit-menu-item-icon')
              .val();
          var role = $(this)
              .find('.edit-menu-item-role')
              .val();
          arr_data.push({
              id: id,
              label: label,
              class: clases,
              link: url,
              menu_icon_class: icon,
              role_id: role
          });
      });

      var data = { arraydata: arr_data };
  }
  console.log('data', data);
  $.ajax({
      data: data,
      url: updateitemr,
      type: 'POST',
      beforeSend: function(xhr) {
          if (id) {
              $('.spincustomu2').show();
          }
      },
      success: function(response) {},
      complete: function() {
          if (id) {
              $('.spincustomu2').hide();
          }
      }
  });
}

function actualizarmenu() {
  $.ajax({
      dataType: 'json',
      data: {
          arraydata: arraydata,
          menuname: $('#menu-name').val(),
          idmenu: $('#idmenu').val()
      },

      url: generatemenucontrolr,
      type: 'POST',
      beforeSend: function(xhr) {
          $('.spincustomu2').show();
      },
      success: function(response) {
          // console.log('aqu llega');
      },
      complete: function() {
          $('.spincustomu2').hide();
      }
  });
}

function deleteitem(id) {
  $.ajax({
      dataType: 'json',
      data: {
          id: id
      },

      url: deleteitemmenur,
      type: 'POST',
      success: function(response) {}
  });
}

function deletemenu() {
  var r = confirm('Do you want to delete this menu ?');
  if (r == true) {
      $.ajax({
          dataType: 'json',

          data: {
              id: $('#idmenu').val()
          },

          url: deletemenugr,
          type: 'POST',
          beforeSend: function(xhr) {
              $('.spincustomu2').show();
          },
          success: function(response) {
              if (!response.error) {
                  alert(response.resp);
                  window.location = menuwr;
              } else {
                  alert(response.resp);
              }
          },
          complete: function() {
              $('.spincustomu2').hide();
          }
      });
  } else {
      return false;
  }
}

function createnewmenu() {
  if (!!$('#menu-name').val()) {
      $.ajax({
          dataType: 'json',

          data: {
              menuname: $('#menu-name').val()
          },

          url: createnewmenur,
          type: 'POST',
          success: function(response) {
              window.location = menuwr + '?menu=' + response.resp;
          }
      });
  } else {
      alert('Enter menu name!');
      $('#menu-name').focus();
      return false;
  }
}

function insertParam(key, value) {
  key = encodeURI(key);
  value = encodeURI(value);

  var kvp = document.location.search.substr(1).split('&');

  var i = kvp.length;
  var x;
  while (i--) {
      x = kvp[i].split('=');

      if (x[0] == key) {
          x[1] = value;
          kvp[i] = x.join('=');
          break;
      }
  }

  if (i < 0) {
      kvp[kvp.length] = [key, value].join('=');
  }

  //this will reload the page, it's likely better to store this until finished
  document.location.search = kvp.join('&');
}

wpNavMenu.registerChange = function() {
  getmenus();
};