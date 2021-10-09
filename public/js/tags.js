function show_edit_form(id, tag) {
  show_elem_by_class('name_tag');
  hide_elem_by_id('name_tag_' + id);
  rm_elem_by_id('tag_edit_form');
  form = create_form();
  form.querySelector('.tag-id').value = id;
  form.querySelector('.tag-name').value = tag;
  form.querySelector('.tag-name').placeholder = tag;
  document.getElementById('edit_tag_' + id).appendChild(form);
}

function create_form(){
  form = document.querySelector('#tag_edit_form_pattern');
  fullForm = form.cloneNode(true);
  fullForm.id = 'tag_edit_form';
  fullForm.querySelector('.tag-id').id = 'edit-id';
  fullForm.querySelector('.tag-name').id = 'edit-tag';
  return fullForm;
}
