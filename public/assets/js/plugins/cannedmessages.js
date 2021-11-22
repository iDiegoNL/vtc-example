/**
 * When a canned message get selected
 */
$('.cannedMessage').change(function () {
  if ($(this).val().length > 0) {
    let commentID = $(this).data('id')
    let system = $('#system').val()
    let id = $('#id').val()
    try {
      $.ajax({ // create an AJAX call...
        type: 'GET',
        url: '/canned/message/' + system + '/' + $(this).val() + '/' + id,
        dataType: 'json',
        success: function (data) { // on success..
          if (data.error === false) {
            let comment = $('#' + commentID).val()
            if (comment.length > 0) {
              $('#' + commentID).val(comment + '\n' + data.message)
            } else {
              $('#' + commentID).val(data.message)
            }

            // Reset the select options
            $('.cannedMessage option:eq(0)').prop('selected', true)
          }

          $('#' + commentID).focus()
        },
        error: function (request, status, error) {
          alert('Something went wrong... ' + error)
        }
      })
    } catch (err) {
      console.error('Something went wrong... ' + err)
    }
  }
})

/**
 * Get tag and set it in the textbox
 *
 * @param element
 * @param text
 */

$('.code').on('click', function () {
  insertAtCaret('content', $(this).data('key'))
})

function insertAtCaret (element, text) {
  element = document.getElementById(element)
  if (document.selection) {
    element.focus()
    let sel = document.selection.createRange()
    sel.text = text
    element.focus()
  } else if (element.selectionStart || element.selectionStart === 0) {
    let startPos = element.selectionStart
    let endPos = element.selectionEnd
    let scrollTop = element.scrollTop
    element.value = element.value.substring(0, startPos) +
      text + element.value.substring(endPos, element.value.length)
    element.focus()
    element.selectionStart = startPos + text.length
    element.selectionEnd = startPos + text.length
    element.scrollTop = scrollTop
  } else {
    element.value += text
    element.focus()
  }
}
