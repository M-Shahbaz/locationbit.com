import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { CKEditor } from '@ckeditor/ckeditor5-react';

const CKEditorLocation = (props) => {
  const editor = ClassicEditor;

  return (
    <CKEditor
      editor={editor}
      data={props.value}
      onChange={(event, editor) => {
        const data = editor.getData();
        props.onChange(data);
      }}
      onReady={(editor) => {
        // You can store the "editor" and use when it is needed.
        // console.log("Editor is ready to use!", editor);
        editor.editing.view.change((writer) => {
          writer.setStyle(
            "height",
            "200px",
            editor.editing.view.document.getRoot()
          );
        });
      }}
      config={{
        toolbar: {
          items: [
            'heading', '|',
            'alignment', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
            'link', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'code', 'codeBlock', '|',
            'insertTable', '|',
            'insertImage', 'blockQuote', '|',
            'undo', 'redo'
          ],
          shouldNotGroupWhenFull: true
        }
      }}
    />
  )
}

export default CKEditorLocation;