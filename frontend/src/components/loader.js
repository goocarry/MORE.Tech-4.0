import { Container, Segment, Loader as LoaderComponent } from 'semantic-ui-react';


export const Loader = ({ minimal }) => {
    if (minimal) {
        return <LoaderComponent active />;
    }

    return (
        <Container>
            <Segment>
                <div className="divider" />,
                <div className="divider" />
                <LoaderComponent active />
            </Segment>
        </Container>
    );
}
