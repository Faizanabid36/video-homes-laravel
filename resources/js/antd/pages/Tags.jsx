import React, { Component } from 'react';
import { Tag, Input, Tooltip } from 'antd';
import { PlusOutlined } from '@ant-design/icons';

class EditableTagGroup extends Component {
    constructor(props){
        super(...arguments);
        this.state = {
            inputVisible: false,
            inputValue: '',
            editInputIndex: -1,
            editInputValue: '',
        };
        this.props = props;
    }

    handleClose(removedTag) {
        const tags = this.props.tags.filter(tag => tag !== removedTag);
        console.log(tags);
        this.props.saveTags(tags);
    };

    showInput() {
        this.setState({ inputVisible: true }, () => this.input.focus());
    };

    handleInputChange (e){
        this.setState({ inputValue: e.target.value });
    };

    handleInputConfirm ()  {
        const { inputValue } = this.state;
        let { tags } = this.props;
        if (inputValue && tags.indexOf(inputValue) === -1) {
            tags = [...tags, inputValue];
        }
        console.log(tags);
        this.props.saveTags(tags);
        this.setState({
            inputVisible: false,
            inputValue: '',
        });
    };

    handleEditInputChange (e) {
        this.setState({ editInputValue: e.target.value });
    };

    handleEditInputConfirm() {
        let {tags} = this.props;
        this.setState(({ editInputIndex, editInputValue }) => {

            const newTags = [...tags];
            newTags[editInputIndex] = editInputValue;

            return {
                tags: newTags,
                editInputIndex: -1,
                editInputValue: '',
            };
        });
    };

    saveInputRef(input) {
        this.input = input;
    };

    saveEditInputRef(input) {
        this.editInput = input;
    };

    render() {
        const {  inputVisible, inputValue, editInputIndex, editInputValue } = this.state;
        const { tags } = this.props;
        return (
            <>
                {tags.length > 0 && tags.map((tag, index) => {
                    if (editInputIndex === index) {
                        return (
                            <Input
                                ref={this.saveEditInputRef}
                                key={tag}
                                size="small"
                                className="tag-input"
                                value={editInputValue}
                                onChange={this.handleInputChange}
                                onBlur={this.handleInputConfirm}
                                onPressEnter={this.handleInputConfirm}
                            />
                        );
                    }

                    const isLongTag = tag.length > 20;

                    const tagElem = (
                        <Tag
                            className="edit-tag"
                            key={tag}
                            closable={index !== 0}
                            onClose={() => this.handleClose(tag)}
                        >
              <span
                  onDoubleClick={e => {
                      if (index !== 0) {
                          this.setState({ editInputIndex: index, editInputValue: tag }, () => {
                              this.editInput.focus();
                          });
                          e.preventDefault();
                      }
                  }}
              >
                {isLongTag ? `${tag.slice(0, 20)}...` : tag}
              </span>
                        </Tag>
                    );
                    return isLongTag ? (
                        <Tooltip title={tag} key={tag}>
                            {tagElem}
                        </Tooltip>
                    ) : (
                        tagElem
                    );
                })}
                {inputVisible && (
                    <Input
                        ref={this.saveInputRef}
                        type="text"
                        size="small"
                        className="tag-input"
                        value={inputValue}
                        onChange={this.handleInputChange}
                        onBlur={this.handleInputConfirm}
                        onPressEnter={this.handleInputConfirm}
                    />
                )}
                {!inputVisible && (
                    <Tag className="site-tag-plus" onClick={this.showInput}>
                        <PlusOutlined /> New Tag
                    </Tag>
                )}
            </>
        );
    }
}
export default EditableTagGroup;
