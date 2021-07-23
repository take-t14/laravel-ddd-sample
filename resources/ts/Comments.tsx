import React, { Component } from "react";
import Comment from "./Comment";

type Props = {[key: string] : any}
type State = {
    comments:Array<any>
  , isFetching:boolean
}

export default class Comments extends React.Component<Props, State> {
  constructor(props: Props) {
    super(props);
  }
  state = {
    comments: [],
    isFetching: true
  };

  async fetchData(url:any) {
    const response = await fetch(url);
    let data = await response.json();
    return data;
  }

  componentDidMount() {
    this.setState(
      {
        comments: JSON.parse(this.props.comments),
        isFetching: false
      },
      () => console.log("New State", this.state.comments)
    );
    /*
    const url = "https://jsonplaceholder.typicode.com/posts/1/comments";
    let data = this.fetchData(url);
    data.then(comments => {
      let commentList = comments.slice(0, 10);
      this.setState(
        {
          comments: commentList,
          isFetching: false
        },
        () => console.log("New State", this.state.comments)
      );
    });*/
  }

  render() {
    const { comments, isFetching } = this.state;
    return isFetching ? "Loading..." : <Comment comments={comments} />;
  }
}
